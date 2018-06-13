﻿/*!
 ColVis 1.1.1
 ©2010-2014 SpryMedia Ltd - datatables.net/license
*/
(function (j, i, k) {
    j = function (d) {
        var e = function (a, b) {
            (!this.CLASS || "ColVis" != this.CLASS) && alert("Warning: ColVis must be initialised with the keyword 'new'");
            "undefined" == typeof b && (b = {});
            d.fn.dataTable.camelToHungarian && d.fn.dataTable.camelToHungarian(e.defaults, b);
            this.s = {
                dt: null,
                oInit: b,
                hidden: !0,
                abOriginal: []
            };
            this.dom = {
                wrapper: null,
                button: null,
                collection: null,
                background: null,
                catcher: null,
                buttons: [],
                groupButtons: [],
                restore: null
            };
            e.aInstances.push(this);
            this.s.dt = d.fn.dataTable.Api ? (new d.fn.dataTable.Api(a)).settings()[0] :
                a;
            this._fnConstruct(b);
            return this
        };
        e.prototype = {
            button: function () {
                return this.dom.wrapper
            },
            fnRebuild: function () {
                this.rebuild()
            },
            rebuild: function () {
                for (var a = this.dom.buttons.length - 1; 0 <= a; a--) this.dom.collection.removeChild(this.dom.buttons[a]);
                this.dom.buttons.splice(0, this.dom.buttons.length);
                this.dom.restore && this.dom.restore.parentNode(this.dom.restore);
                this._fnAddGroups();
                this._fnAddButtons();
                this._fnDrawCallback()
            },
            _fnConstruct: function (a) {
                this._fnApplyCustomisation(a);
                var b = this,
                    c, f;
                this.dom.wrapper =
                    i.createElement("div");
                this.dom.wrapper.className = "ColVis";
                this.dom.button = d("<button />", {
                    "class": !this.s.dt.bJUI ? "ColVis_Button ColVis_MasterButton" : "ColVis_Button ColVis_MasterButton ui-button ui-state-default"
                }).append("<span>" + this.s.buttonText + "</span>").bind("mouseover" == this.s.activate ? "mouseover" : "click", function (a) {
                    a.preventDefault();
                    b._fnCollectionShow()
                }).appendTo(this.dom.wrapper)[0];
                this.dom.catcher = this._fnDomCatcher();
                this.dom.collection = this._fnDomCollection();
                this.dom.background =
                    this._fnDomBackground();
                this._fnAddGroups();
                this._fnAddButtons();
                c = 0;
                for (f = this.s.dt.aoColumns.length; c < f; c++) this.s.abOriginal.push(this.s.dt.aoColumns[c].bVisible);
                this.s.dt.aoDrawCallback.push({
                    fn: function () {
                        b._fnDrawCallback.call(b)
                    },
                    sName: "ColVis"
                });
                d(this.s.dt.oInstance).bind("column-reorder", function (a, d, e) {
                    c = 0;
                    for (f = b.s.aiExclude.length; c < f; c++) b.s.aiExclude[c] = e.aiInvertMapping[b.s.aiExclude[c]];
                    a = b.s.abOriginal.splice(e.iFrom, 1)[0];
                    b.s.abOriginal.splice(e.iTo, 0, a);
                    b.fnRebuild()
                });
                this._fnDrawCallback()
            },
            _fnApplyCustomisation: function (a) {
                d.extend(!0, this.s, e.defaults, a);
                !this.s.showAll && this.s.bShowAll && (this.s.showAll = this.s.sShowAll);
                !this.s.restore && this.s.bRestore && (this.s.restore = this.s.sRestore);
                var a = this.s.groups,
                    b = this.s.aoGroups;
                if (a)
                    for (var c = 0, f = a.length; c < f; c++)
                        if (a[c].title && (b[c].sTitle = a[c].title), a[c].columns) b[c].aiColumns = a[c].columns
            },
            _fnDrawCallback: function () {
                for (var a = this.s.dt.aoColumns, b = this.dom.buttons, c = this.s.aoGroups, f, g = 0, h = b.length; g < h; g++) f = b[g], f.__columnIdx !== k &&
                    d("input", f).prop("checked", a[f.__columnIdx].bVisible);
                b = 0;
                for (f = c.length; b < f; b++) {
                    a: {
                        for (var g = c[b].aiColumns, h = 0, e = g.length; h < e; h++)
                            if (!1 === a[g[h]].bVisible) {
                                g = !1;
                                break a
                            }
                        g = !0
                    }
                    if (g) d("input", this.dom.groupButtons[b]).prop("checked", !0),
                    d("input", this.dom.groupButtons[b]).prop("indeterminate", !1);
                    else {
                        a: {
                            g = c[b].aiColumns; h = 0;
                            for (e = g.length; h < e; h++)
                                if (!0 === a[g[h]].bVisible) {
                                    g = !1;
                                    break a
                                }
                            g = !0
                        }
                        g ? (d("input", this.dom.groupButtons[b]).prop("checked", !1), d("input", this.dom.groupButtons[b]).prop("indeterminate", !1)) : d("input", this.dom.groupButtons[b]).prop("indeterminate", !0)
                    }
                }
            },
            _fnAddGroups: function () {
                var a;
                if ("undefined" != typeof this.s.aoGroups)
                    for (var b = 0, c = this.s.aoGroups.length; b < c; b++) a = this._fnDomGroupButton(b), this.dom.groupButtons.push(a), this.dom.buttons.push(a), this.dom.collection.appendChild(a)
            },
            _fnAddButtons: function () {
                var a, b = this.s.dt.aoColumns;
                if (-1 === d.inArray("all", this.s.aiExclude))
                    for (var c = 0, f = b.length; c < f; c++) -1 === d.inArray(c, this.s.aiExclude) && (a = this._fnDomColumnButton(c), a.__columnIdx =
                        c, this.dom.buttons.push(a));
                "alpha" === this.s.order && this.dom.buttons.sort(function (a, c) {
                    var d = b[a.__columnIdx].sTitle,
                        f = b[c.__columnIdx].sTitle;
                    return d === f ? 0 : d < f ? -1 : 1
                });
                this.s.restore && (a = this._fnDomRestoreButton(), a.className += " ColVis_Restore", this.dom.buttons.push(a));
                this.s.showAll && (a = this._fnDomShowXButton(this.s.showAll, !0), a.className += " ColVis_ShowAll", this.dom.buttons.push(a));
                this.s.showNone && (a = this._fnDomShowXButton(this.s.showNone, !1), a.className += " ColVis_ShowNone", this.dom.buttons.push(a));
                d(this.dom.collection).append(this.dom.buttons)
            },
            _fnDomRestoreButton: function () {
                var a = this;
                return d('<li class="ColVis_Special ' + (this.s.dt.bJUI ? "ui-button ui-state-default" : "") + '">' + this.s.restore + "</li>").click(function () {
                    for (var b = 0, c = a.s.abOriginal.length; b < c; b++) a.s.dt.oInstance.fnSetColumnVis(b, a.s.abOriginal[b], !1);
                    a._fnAdjustOpenRows();
                    a.s.dt.oInstance.fnAdjustColumnSizing(!1);
                    a.s.dt.oInstance.fnDraw(!1)
                })[0]
            },
            _fnDomShowXButton: function (a, b) {
                var c = this;
                return d('<li class="ColVis_Special ' +
                    (this.s.dt.bJUI ? "ui-button ui-state-default" : "") + '">' + a + "</li>").click(function () {
                        for (var a = 0, d = c.s.abOriginal.length; a < d; a++) -1 === c.s.aiExclude.indexOf(a) && c.s.dt.oInstance.fnSetColumnVis(a, b, !1);
                        c._fnAdjustOpenRows();
                        c.s.dt.oInstance.fnAdjustColumnSizing(!1);
                        c.s.dt.oInstance.fnDraw(!1)
                    })[0]
            },
            _fnDomGroupButton: function (a) {
                var b = this,
                    c = this.s.aoGroups[a];
                return d('<li class="ColVis_Special ' + (this.s.dt.bJUI ? "ui-button ui-state-default" : "") + '"><label><input type="checkbox" /><span>' + c.sTitle + "</span></label></li>").click(function (a) {
                    var g = !d("input", this).is(":checked");
                    "li" !== a.target.nodeName.toLowerCase() && (g = !g);
                    for (a = 0; a < c.aiColumns.length; a++) b.s.dt.oInstance.fnSetColumnVis(c.aiColumns[a], g)
                })[0]
            },
            _fnDomColumnButton: function (a) {
                var b = this,
                    c = this.s.dt.aoColumns[a],
                    f = this.s.dt,
                    c = null === this.s.fnLabel ? c.sTitle : this.s.fnLabel(a, c.sTitle, c.nTh);
                return d("<li " + (f.bJUI ? 'class="ui-button ui-state-default"' : "") + '><label><input type="checkbox" /><span>' + c + "</span></label></li>").click(function (c) {
                    var e = !d("input", this).is(":checked");
                    "li" !== c.target.nodeName.toLowerCase() && (e = !e);
                    var i = d.fn.dataTableExt.iApiIndex;
                    d.fn.dataTableExt.iApiIndex = b._fnDataTablesApiIndex.call(b);
                    f.oFeatures.bServerSide ? (b.s.dt.oInstance.fnSetColumnVis(a, e, !1), b.s.dt.oInstance.fnAdjustColumnSizing(!1), ("" !== f.oScroll.sX || "" !== f.oScroll.sY) && b.s.dt.oInstance.oApi._fnScrollDraw(b.s.dt), b._fnDrawCallback()) : b.s.dt.oInstance.fnSetColumnVis(a, e);
                    d.fn.dataTableExt.iApiIndex = i;
                    "input" === c.target.nodeName.toLowerCase() && null !== b.s.fnStateChange && b.s.fnStateChange.call(b,
                        a, e)
                })[0]
            },
            _fnDataTablesApiIndex: function () {
                for (var a = 0, b = this.s.dt.oInstance.length; a < b; a++)
                    if (this.s.dt.oInstance[a] == this.s.dt.nTable) return a;
                return 0
            },
            _fnDomCollection: function () {
                return d("<ul />", {
                    "class": !this.s.dt.bJUI ? "ColVis_collection" : "ColVis_collection ui-buttonset ui-buttonset-multi"
                }).css({
                    display: "none",
                    opacity: 0,
                    position: !this.s.bCssPosition ? "absolute" : ""
                })[0]
            },
            _fnDomCatcher: function () {
                var a = this,
                    b = i.createElement("div");
                b.className = "ColVis_catcher";
                d(b).click(function () {
                    a._fnCollectionHide.call(a,
                        null, null)
                });
                return b
            },
            _fnDomBackground: function () {
                var a = this,
                    b = d("<div></div>").addClass("ColVis_collectionBackground").css("opacity", 0).click(function () {
                        a._fnCollectionHide.call(a, null, null)
                    });
                "mouseover" == this.s.activate && b.mouseover(function () {
                    a.s.overcollection = !1;
                    a._fnCollectionHide.call(a, null, null)
                });
                return b[0]
            },
            _fnCollectionShow: function () {
                var a = this,
                    b;
                b = d(this.dom.button).offset();
                var c = this.dom.collection,
                    f = this.dom.background,
                    e = parseInt(b.left, 10),
                    h = parseInt(b.top + d(this.dom.button).outerHeight(),
                        10);
                this.s.bCssPosition || (c.style.top = h + "px", c.style.left = e + "px");
                d(c).css({
                    display: "block",
                    opacity: 0
                });
                f.style.bottom = "0px";
                f.style.right = "0px";
                h = this.dom.catcher.style;
                h.height = d(this.dom.button).outerHeight() + "px";
                h.width = d(this.dom.button).outerWidth() + "px";
                h.top = b.top + "px";
                h.left = e + "px";
                i.body.appendChild(f);
                i.body.appendChild(c);
                i.body.appendChild(this.dom.catcher);
                d(c).animate({
                    opacity: 1
                }, a.s.iOverlayFade);
                d(f).animate({
                    opacity: 0.1
                }, a.s.iOverlayFade, "linear", function () {
                    d.browser && (d.browser.msie &&
                        d.browser.version == "6.0") && a._fnDrawCallback()
                });
                this.s.bCssPosition || (b = "left" == this.s.sAlign ? e : e - d(c).outerWidth() + d(this.dom.button).outerWidth(), c.style.left = b + "px", f = d(c).outerWidth(), d(c).outerHeight(), e = d(i).width(), b + f > e && (c.style.left = e - f + "px"));
                this.s.hidden = !1
            },
            _fnCollectionHide: function () {
                var a = this;
                !this.s.hidden && null !== this.dom.collection && (this.s.hidden = !0, d(this.dom.collection).animate({
                    opacity: 0
                }, a.s.iOverlayFade, function () {
                    this.style.display = "none"
                }), d(this.dom.background).animate({
                    opacity: 0
                },
                    a.s.iOverlayFade,
                    function () {
                        i.body.removeChild(a.dom.background);
                        i.body.removeChild(a.dom.catcher)
                    }))
            },
            _fnAdjustOpenRows: function () {
                for (var a = this.s.dt.aoOpenRows, b = this.s.dt.oApi._fnVisbleColumns(this.s.dt), c = 0, d = a.length; c < d; c++) a[c].nTr.getElementsByTagName("td")[0].colSpan = b
            }
        };
        e.fnRebuild = function (a) {
            var b = null;
            "undefined" != typeof a && (b = a.fnSettings().nTable);
            for (var c = 0, d = e.aInstances.length; c < d; c++) ("undefined" == typeof a || b == e.aInstances[c].s.dt.nTable) && e.aInstances[c].fnRebuild()
        };
        e.defaults = {
            active: "click",
            buttonText: "Show / hide columns",
            aiExclude: [],
            bRestore: !1,
            sRestore: "Restore original",
            bShowAll: !1,
            sShowAll: "Show All",
            sAlign: "left",
            fnStateChange: null,
            iOverlayFade: 500,
            fnLabel: null,
            bCssPosition: !1,
            aoGroups: [],
            order: "column"
        };
        e.aInstances = [];
        e.prototype.CLASS = "ColVis";
        e.VERSION = "1.1.1";
        e.prototype.VERSION = e.VERSION;
        "function" == typeof d.fn.dataTable && "function" == typeof d.fn.dataTableExt.fnVersionCheck && d.fn.dataTableExt.fnVersionCheck("1.7.0") ? d.fn.dataTableExt.aoFeatures.push({
            fnInit: function (a) {
                var b =
                    a.oInit;
                return (new e(a, b.colVis || b.oColVis || {})).button()
            },
            cFeature: "C",
            sFeature: "ColVis"
        }) : alert("Warning: ColVis requires DataTables 1.7 or greater - www.datatables.net/download");
        d.fn.dataTable.ColVis = e;
        return d.fn.DataTable.ColVis = e
    };
    "function" === typeof define && define.amd ? define(["jquery", "datatables"], j) : "object" === typeof exports ? j(require("jquery"), require("datatables")) : jQuery && !jQuery.fn.dataTable.ColVis && j(jQuery, jQuery.fn.dataTable)
})(window, document);