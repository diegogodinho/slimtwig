﻿/*!
 ColReorder 1.1.2
 ©2010-2014 SpryMedia Ltd - datatables.net/license
*/
(function (n, q, r) {
    function o(b) {
        for (var f = [], a = 0, e = b.length; a < e; a++) f[b[a]] = a;
        return f
    }

    function l(b, f, a) {
        f = b.splice(f, 1)[0];
        b.splice(a, 0, f)
    }

    function p(b, f, a) {
        for (var e = [], c = 0, d = b.childNodes.length; c < d; c++) 1 == b.childNodes[c].nodeType && e.push(b.childNodes[c]);
        f = e[f];
        null !== a ? b.insertBefore(f, e[a]) : b.appendChild(f)
    }
    $.fn.dataTableExt.oApi.fnColReorder = function (b, f, a) {
        var e = $.fn.dataTable.Api ? !0 : !1,
            c, d, j, i, m = b.aoColumns.length,
            g, h;
        g = function (a, c, b) {
            if (a[c]) {
                var e = a[c].split("."),
                    d = e.shift();
                isNaN(1 * d) ||
                    (a[c] = b[1 * d] + "." + e.join("."))
            }
        };
        if (f != a)
            if (0 > f || f >= m) this.oApi._fnLog(b, 1, "ColReorder 'from' index is out of bounds: " + f);
            else if (0 > a || a >= m) this.oApi._fnLog(b, 1, "ColReorder 'to' index is out of bounds: " + a);
            else {
                j = [];
                c = 0;
                for (d = m; c < d; c++) j[c] = c;
                l(j, f, a);
                var k = o(j);
                c = 0;
                for (d = b.aaSorting.length; c < d; c++) b.aaSorting[c][0] = k[b.aaSorting[c][0]];
                if (null !== b.aaSortingFixed) {
                    c = 0;
                    for (d = b.aaSortingFixed.length; c < d; c++) b.aaSortingFixed[c][0] = k[b.aaSortingFixed[c][0]]
                }
                c = 0;
                for (d = m; c < d; c++) {
                    h = b.aoColumns[c];
                    j = 0;
                    for (i = h.aDataSort.length; j < i; j++) h.aDataSort[j] = k[h.aDataSort[j]];
                    e && (h.idx = k[h.idx])
                }
                e && $.each(b.aLastSort, function (a, c) {
                    b.aLastSort[a].src = k[c.src]
                });
                c = 0;
                for (d = m; c < d; c++) h = b.aoColumns[c], "number" == typeof h.mData ? (h.mData = k[h.mData], b.oApi._fnColumnOptions(b, c, {})) : $.isPlainObject(h.mData) && (g(h.mData, "_", k), g(h.mData, "filter", k), g(h.mData, "sort", k), g(h.mData, "type", k), b.oApi._fnColumnOptions(b, c, {}));
                if (b.aoColumns[f].bVisible) {
                    j = this.oApi._fnColumnIndexToVisible(b, f);
                    i = null;
                    for (c = a < f ? a : a + 1; null ===
                        i && c < m;) i = this.oApi._fnColumnIndexToVisible(b, c), c++;
                    g = b.nTHead.getElementsByTagName("tr");
                    c = 0;
                    for (d = g.length; c < d; c++) p(g[c], j, i);
                    if (null !== b.nTFoot) {
                        g = b.nTFoot.getElementsByTagName("tr");
                        c = 0;
                        for (d = g.length; c < d; c++) p(g[c], j, i)
                    }
                    c = 0;
                    for (d = b.aoData.length; c < d; c++) null !== b.aoData[c].nTr && p(b.aoData[c].nTr, j, i)
                }
                l(b.aoColumns, f, a);
                l(b.aoPreSearchCols, f, a);
                c = 0;
                for (d = b.aoData.length; c < d; c++) g = b.aoData[c], e ? (g.anCells && l(g.anCells, f, a), "dom" !== g.src && $.isArray(g._aData) && l(g._aData, f, a)) : ($.isArray(g._aData) &&
                    l(g._aData, f, a), l(g._anHidden, f, a));
                c = 0;
                for (d = b.aoHeader.length; c < d; c++) l(b.aoHeader[c], f, a);
                if (null !== b.aoFooter) {
                    c = 0;
                    for (d = b.aoFooter.length; c < d; c++) l(b.aoFooter[c], f, a)
                }
                e && (new $.fn.dataTable.Api(b)).rows().invalidate();
                c = 0;
                for (d = m; c < d; c++) $(b.aoColumns[c].nTh).off("click.DT"), this.oApi._fnSortAttachListener(b, b.aoColumns[c].nTh, c);
                $(b.oInstance).trigger("column-reorder", [b, {
                    iFrom: f,
                    iTo: a,
                    aiInvertMapping: k
                }])
            }
    };
    n = function (b) {
        var f = function (a, e) {
            var c;
            b.fn.dataTable.Api ? c = (new b.fn.dataTable.Api(a)).settings()[0] :
                a.fnSettings ? c = a.fnSettings() : "string" === typeof a ? b.fn.dataTable.fnIsDataTable(b(a)[0]) && (c = b(a).eq(0).dataTable().fnSettings()) : a.nodeName && "table" === a.nodeName.toLowerCase() ? b.fn.dataTable.fnIsDataTable(a.nodeName) && (c = b(a.nodeName).dataTable().fnSettings()) : a instanceof jQuery ? b.fn.dataTable.fnIsDataTable(a[0]) && (c = a.eq(0).dataTable().fnSettings()) : c = a;
            var d = b.fn.dataTable.camelToHungarian;
            d && (d(f.defaults, f.defaults, !0), d(f.defaults, e || {}));
            this.s = {
                dt: null,
                init: b.extend(!0, {}, f.defaults, e),
                fixed: 0,
                fixedRight: 0,
                dropCallback: null,
                mouse: {
                    startX: -1,
                    startY: -1,
                    offsetX: -1,
                    offsetY: -1,
                    target: -1,
                    targetIndex: -1,
                    fromIndex: -1
                },
                aoTargets: []
            };
            this.dom = {
                drag: null,
                pointer: null
            };
            this.s.dt = c.oInstance.fnSettings();
            this.s.dt._colReorder = this;
            this._fnConstruct();
            c.oApi._fnCallbackReg(c, "aoDestroyCallback", b.proxy(this._fnDestroy, this), "ColReorder");
            return this
        };
        f.prototype = {
            fnReset: function () {
                for (var a = [], b = 0, c = this.s.dt.aoColumns.length; b < c; b++) a.push(this.s.dt.aoColumns[b]._ColReorder_iOrigCol);
                this._fnOrderColumns(a);
                return this
            },
            fnGetCurrentOrder: function () {
                return this.fnOrder()
            },
            fnOrder: function (a) {
                if (a === r) {
                    for (var a = [], b = 0, c = this.s.dt.aoColumns.length; b < c; b++) a.push(this.s.dt.aoColumns[b]._ColReorder_iOrigCol);
                    return a
                }
                this._fnOrderColumns(o(a));
                return this
            },
            _fnConstruct: function () {
                var a = this,
                    b = this.s.dt.aoColumns.length,
                    c;
                this.s.init.iFixedColumns && (this.s.fixed = this.s.init.iFixedColumns);
                this.s.fixedRight = this.s.init.iFixedColumnsRight ? this.s.init.iFixedColumnsRight : 0;
                this.s.init.fnReorderCallback && (this.s.dropCallback =
                    this.s.init.fnReorderCallback);
                for (c = 0; c < b; c++) c > this.s.fixed - 1 && c < b - this.s.fixedRight && this._fnMouseListener(c, this.s.dt.aoColumns[c].nTh), this.s.dt.aoColumns[c]._ColReorder_iOrigCol = c;
                this.s.dt.oApi._fnCallbackReg(this.s.dt, "aoStateSaveParams", function (c, b) {
                    a._fnStateSave.call(a, b)
                }, "ColReorder_State");
                var d = null;
                this.s.init.aiOrder && (d = this.s.init.aiOrder.slice());
                this.s.dt.oLoadedState && ("undefined" != typeof this.s.dt.oLoadedState.ColReorder && this.s.dt.oLoadedState.ColReorder.length == this.s.dt.aoColumns.length) &&
                    (d = this.s.dt.oLoadedState.ColReorder);
                if (d)
                    if (a.s.dt._bInitComplete) b = o(d), a._fnOrderColumns.call(a, b);
                    else {
                        var f = !1;
                        this.s.dt.aoDrawCallback.push({
                            fn: function () {
                                if (!a.s.dt._bInitComplete && !f) {
                                    f = true;
                                    var c = o(d);
                                    a._fnOrderColumns.call(a, c)
                                }
                            },
                            sName: "ColReorder_Pre"
                        })
                    } else this._fnSetColumnIndexes()
            },
            _fnOrderColumns: function (a) {
                if (a.length != this.s.dt.aoColumns.length) this.s.dt.oInstance.oApi._fnLog(this.s.dt, 1, "ColReorder - array reorder does not match known number of columns. Skipping.");
                else {
                    for (var e =
                            0, c = a.length; e < c; e++) {
                        var d = b.inArray(e, a);
                        e != d && (l(a, d, e), this.s.dt.oInstance.fnColReorder(d, e))
                    } ("" !== this.s.dt.oScroll.sX || "" !== this.s.dt.oScroll.sY) && this.s.dt.oInstance.fnAdjustColumnSizing();
                    this.s.dt.oInstance.oApi._fnSaveState(this.s.dt);
                    this._fnSetColumnIndexes()
                }
            },
            _fnStateSave: function (a) {
                var e, c, d, f = this.s.dt.aoColumns;
                a.ColReorder = [];
                if (a.aaSorting) {
                    for (e = 0; e < a.aaSorting.length; e++) a.aaSorting[e][0] = f[a.aaSorting[e][0]]._ColReorder_iOrigCol;
                    var i = b.extend(!0, [], a.aoSearchCols);
                    e = 0;
                    for (c =
                        f.length; e < c; e++) d = f[e]._ColReorder_iOrigCol, a.aoSearchCols[d] = i[e], a.abVisCols[d] = f[e].bVisible, a.ColReorder.push(d)
                } else if (a.order) {
                    for (e = 0; e < a.order.length; e++) a.order[e][0] = f[a.order[e][0]]._ColReorder_iOrigCol;
                    i = b.extend(!0, [], a.columns);
                    e = 0;
                    for (c = f.length; e < c; e++) d = f[e]._ColReorder_iOrigCol, a.columns[d] = i[e], a.ColReorder.push(d)
                }
            },
            _fnMouseListener: function (a, e) {
                var c = this;
                b(e).on("mousedown.ColReorder", function (a) {
                    a.preventDefault();
                    c._fnMouseDown.call(c, a, e)
                })
            },
            _fnMouseDown: function (a, e) {
                var c =
                    this,
                    d = b(a.target).closest("th, td").offset(),
                    f = parseInt(b(e).attr("data-column-index"), 10);
                f !== r && (this.s.mouse.startX = a.pageX, this.s.mouse.startY = a.pageY, this.s.mouse.offsetX = a.pageX - d.left, this.s.mouse.offsetY = a.pageY - d.top, this.s.mouse.target = this.s.dt.aoColumns[f].nTh, this.s.mouse.targetIndex = f, this.s.mouse.fromIndex = f, this._fnRegions(), b(q).on("mousemove.ColReorder", function (a) {
                    c._fnMouseMove.call(c, a)
                }).on("mouseup.ColReorder", function (a) {
                    c._fnMouseUp.call(c, a)
                }))
            },
            _fnMouseMove: function (a) {
                if (null ===
                    this.dom.drag) {
                    if (5 > Math.pow(Math.pow(a.pageX - this.s.mouse.startX, 2) + Math.pow(a.pageY - this.s.mouse.startY, 2), 0.5)) return;
                    this._fnCreateDragNode()
                }
                this.dom.drag.css({
                    left: a.pageX - this.s.mouse.offsetX,
                    top: a.pageY - this.s.mouse.offsetY
                });
                for (var b = !1, c = this.s.mouse.toIndex, d = 1, f = this.s.aoTargets.length; d < f; d++)
                    if (a.pageX < this.s.aoTargets[d - 1].x + (this.s.aoTargets[d].x - this.s.aoTargets[d - 1].x) / 2) {
                        this.dom.pointer.css("left", this.s.aoTargets[d - 1].x);
                        this.s.mouse.toIndex = this.s.aoTargets[d - 1].to;
                        b = !0;
                        break
                    }
                b ||
                    (this.dom.pointer.css("left", this.s.aoTargets[this.s.aoTargets.length - 1].x), this.s.mouse.toIndex = this.s.aoTargets[this.s.aoTargets.length - 1].to);
                this.s.init.bRealtime && c !== this.s.mouse.toIndex && (this.s.dt.oInstance.fnColReorder(this.s.mouse.fromIndex, this.s.mouse.toIndex), this.s.mouse.fromIndex = this.s.mouse.toIndex, this._fnRegions())
            },
            _fnMouseUp: function () {
                b(q).off("mousemove.ColReorder mouseup.ColReorder");
                null !== this.dom.drag && (this.dom.drag.remove(), this.dom.pointer.remove(), this.dom.drag = null,
                    this.dom.pointer = null, this.s.dt.oInstance.fnColReorder(this.s.mouse.fromIndex, this.s.mouse.toIndex), this._fnSetColumnIndexes(), ("" !== this.s.dt.oScroll.sX || "" !== this.s.dt.oScroll.sY) && this.s.dt.oInstance.fnAdjustColumnSizing(), null !== this.s.dropCallback && this.s.dropCallback.call(this), this.s.dt.oInstance.oApi._fnSaveState(this.s.dt))
            },
            _fnRegions: function () {
                var a = this.s.dt.aoColumns;
                this.s.aoTargets.splice(0, this.s.aoTargets.length);
                this.s.aoTargets.push({
                    x: b(this.s.dt.nTable).offset().left,
                    to: 0
                });
                for (var e = 0, c = 0, d = a.length; c < d; c++) c != this.s.mouse.fromIndex && e++, a[c].bVisible && this.s.aoTargets.push({
                    x: b(a[c].nTh).offset().left + b(a[c].nTh).outerWidth(),
                    to: e
                });
                0 !== this.s.fixedRight && this.s.aoTargets.splice(this.s.aoTargets.length - this.s.fixedRight);
                0 !== this.s.fixed && this.s.aoTargets.splice(0, this.s.fixed)
            },
            _fnCreateDragNode: function () {
                var a = "" !== this.s.dt.oScroll.sX || "" !== this.s.dt.oScroll.sY,
                    e = this.s.dt.aoColumns[this.s.mouse.targetIndex].nTh,
                    c = e.parentNode,
                    d = c.parentNode,
                    f = d.parentNode,
                    i = b(e).clone();
                this.dom.drag = b(f.cloneNode(!1)).addClass("DTCR_clonedTable").append(d.cloneNode(!1).appendChild(c.cloneNode(!1).appendChild(i[0]))).css({
                    position: "absolute",
                    top: 0,
                    left: 0,
                    width: b(e).outerWidth(),
                    height: b(e).outerHeight()
                }).appendTo("body");
                this.dom.pointer = b("<div></div>").addClass("DTCR_pointer").css({
                    position: "absolute",
                    top: a ? b("div.dataTables_scroll", this.s.dt.nTableWrapper).offset().top : b(this.s.dt.nTable).offset().top,
                    height: a ? b("div.dataTables_scroll", this.s.dt.nTableWrapper).height() : b(this.s.dt.nTable).height()
                }).appendTo("body")
            },
            _fnDestroy: function () {
                var a, e;
                a = 0;
                for (e = this.s.dt.aoDrawCallback.length; a < e; a++)
                    if ("ColReorder_Pre" === this.s.dt.aoDrawCallback[a].sName) {
                        this.s.dt.aoDrawCallback.splice(a, 1);
                        break
                    }
                b(this.s.dt.nTHead).find("*").off(".ColReorder");
                b.each(this.s.dt.aoColumns, function (a, e) {
                    b(e.nTh).removeAttr("data-column-index")
                });
                this.s = this.s.dt._colReorder = null
            },
            _fnSetColumnIndexes: function () {
                b.each(this.s.dt.aoColumns, function (a, e) {
                    b(e.nTh).attr("data-column-index", a)
                })
            }
        };
        f.defaults = {
            aiOrder: null,
            bRealtime: !1,
            iFixedColumns: 0,
            iFixedColumnsRight: 0,
            fnReorderCallback: null
        };
        f.version = "1.1.2";
        b.fn.dataTable.ColReorder = f;
        b.fn.DataTable.ColReorder = f;
        "function" == typeof b.fn.dataTable && "function" == typeof b.fn.dataTableExt.fnVersionCheck && b.fn.dataTableExt.fnVersionCheck("1.9.3") ? b.fn.dataTableExt.aoFeatures.push({
            fnInit: function (a) {
                var b = a.oInstance;
                a._colReorder ? b.oApi._fnLog(a, 1, "ColReorder attempted to initialise twice. Ignoring second") : (b = a.oInit, new f(a, b.colReorder || b.oColReorder || {}));
                return null
            },
            cFeature: "R",
            sFeature: "ColReorder"
        }) :
            alert("Warning: ColReorder requires DataTables 1.9.3 or greater - www.datatables.net/download");
        b.fn.dataTable.Api && (b.fn.dataTable.Api.register("colReorder.reset()", function () {
            return this.iterator("table", function (a) {
                a._colReorder.fnReset()
            })
        }), b.fn.dataTable.Api.register("colReorder.order()", function (a) {
            return a ? this.iterator("table", function (b) {
                b._colReorder.fnOrder(a)
            }) : this.context.length ? this.context[0]._colReorder.fnOrder() : null
        }));
        return f
    };
    "function" === typeof define && define.amd ? define(["jquery",
        "datatables"
    ], n) : "object" === typeof exports ? n(require("jquery"), require("datatables")) : jQuery && !jQuery.fn.dataTable.ColReorder && n(jQuery, jQuery.fn.dataTable)
})(window, document);