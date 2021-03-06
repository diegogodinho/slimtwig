﻿! function (a, b) {
    "object" == typeof exports ? module.exports = b(require("moment")) : "function" == typeof define && define.amd ? define(["moment"], b) : a.moment = b(a.moment)
}(this, function (a) {
    var b, c;
    return c = {
        year: !0,
        month: !0,
        week: !0,
        day: !0,
        hour: !0,
        minute: !0,
        second: !0
    }, b = function () {
        function b(b, c) {
            this.start = a(b), this.end = a(c)
        }
        return b.prototype.contains = function (a) {
            return a instanceof b ? this.start <= a.start && this.end >= a.end : this.start <= a && a <= this.end
        }, b.prototype._by_string = function (b, c) {
            var d, e;
            for (d = a(this.start), e = []; this.contains(d) ;) c.call(this, d.clone()), e.push(d.add(1, b));
            return e
        }, b.prototype._by_range = function (b, c) {
            var d, e, f, g;
            if (e = Math.floor(this / b), 1 / 0 === e) return this;
            for (g = [], d = f = 0; e >= 0 ? e >= f : f >= e; d = e >= 0 ? ++f : --f) g.push(c.call(this, a(this.start.valueOf() + b.valueOf() * d)));
            return g
        }, b.prototype.overlaps = function (a) {
            return null !== this.intersect(a)
        }, b.prototype.intersect = function (a) {
            var c, d, e, f, g, h, i, j;
            return this.start <= (d = a.start) && d < (c = this.end) && c < a.end ? new b(a.start, this.end) : a.start < (f = this.start) && f < (e = a.end) && e <= this.end ? new b(this.start, a.end) : a.start < (h = this.start) && h < (g = this.end) && g < a.end ? this : this.start <= (j = a.start) && j < (i = a.end) && i <= this.end ? a : null
        }, b.prototype.subtract = function (a) {
            var c, d, e, f, g, h, i, j;
            return null === this.intersect(a) ? [this] : a.start <= (d = this.start) && d < (c = this.end) && c <= a.end ? [] : a.start <= (f = this.start) && f < (e = a.end) && e < this.end ? [new b(a.end, this.end)] : this.start < (h = a.start) && h < (g = this.end) && g <= a.end ? [new b(this.start, a.start)] : this.start < (j = a.start) && j < (i = a.end) && i < this.end ? [new b(this.start, a.start), new b(a.end, this.end)] : void 0
        }, b.prototype.by = function (a, b) {
            return "string" == typeof a ? this._by_string(a, b) : this._by_range(a, b), this
        }, b.prototype.valueOf = function () {
            return this.end - this.start
        }, b.prototype.toDate = function () {
            return [this.start.toDate(), this.end.toDate()]
        }, b.prototype.isSame = function (a) {
            return this.start.isSame(a.start) && this.end.isSame(a.end)
        }, b.prototype.diff = function (a) {
            return null == a && (a = void 0), this.end.diff(this.start, a)
        }, b
    }(), a.fn.range = function (d, e) {
        return d in c ? new b(a(this).startOf(d), a(this).endOf(d)) : new b(d, e)
    }, a.range = function (a, c) {
        return new b(a, c)
    }, a.fn.within = function (a) {
        return a.contains(this._d)
    }, a
});