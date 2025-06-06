/*
 * bootstrap-tagsinput v0.5.0 by Tim Schlechter
 * 
 */
!(function (a) {
    "use strict";
    function b(b, c) {
        (this.itemsArray = []),
            (this.$element = a(b)),
            this.$element.hide(),
            (this.isSelect = "SELECT" === b.tagName),
            (this.multiple = this.isSelect && b.hasAttribute("multiple")),
            (this.objectItems = c && c.itemValue),
            (this.placeholderText = b.hasAttribute("placeholder") ? this.$element.attr("placeholder") : ""),
            (this.inputSize = Math.max(1, this.placeholderText.length)),
            (this.$container = a('<div class="bootstrap-tagsinput"></div>')),
            (this.$input = a('<input type="text" placeholder="' + this.placeholderText + '"/>').appendTo(this.$container)),
            this.$element.before(this.$container),
            this.build(c);
    }
    function c(a, b) {
        if ("function" != typeof a[b]) {
            var c = a[b];
            a[b] = function (a) {
                return a[c];
            };
        }
    }
    function d(a, b) {
        if ("function" != typeof a[b]) {
            var c = a[b];
            a[b] = function () {
                return c;
            };
        }
    }
    function e(a) {
        return a ? i.text(a).html() : "";
    }
    function f(a) {
        var b = 0;
        if (document.selection) {
            a.focus();
            var c = document.selection.createRange();
            c.moveStart("character", -a.value.length), (b = c.text.length);
        } else (a.selectionStart || "0" == a.selectionStart) && (b = a.selectionStart);
        return b;
    }
    function g(b, c) {
        var d = !1;
        return (
            a.each(c, function (a, c) {
                if ("number" == typeof c && b.which === c) return (d = !0), !1;
                if (b.which === c.which) {
                    var e = !c.hasOwnProperty("altKey") || b.altKey === c.altKey,
                        f = !c.hasOwnProperty("shiftKey") || b.shiftKey === c.shiftKey,
                        g = !c.hasOwnProperty("ctrlKey") || b.ctrlKey === c.ctrlKey;
                    if (e && f && g) return (d = !0), !1;
                }
            }),
            d
        );
    }
    var h = {
        tagClass: function () {
            return "label label-info";
        },
        itemValue: function (a) {
            return a ? a.toString() : a;
        },
        itemText: function (a) {
            return this.itemValue(a);
        },
        itemTitle: function () {
            return null;
        },
        freeInput: !0,
        addOnBlur: !0,
        maxTags: void 0,
        maxChars: void 0,
        confirmKeys: [13, 44],
        onTagExists: function (a, b) {
            b.hide().fadeIn();
        },
        trimValue: !1,
        allowDuplicates: !1,
    };
    (b.prototype = {
        constructor: b,
        add: function (b, c, d) {
            var f = this;
            if (!((f.options.maxTags && f.itemsArray.length >= f.options.maxTags) || (b !== !1 && !b))) {
                if (("string" == typeof b && f.options.trimValue && (b = a.trim(b)), "object" == typeof b && !f.objectItems)) throw "Can't add objects when itemValue option is not set";
                if (!b.toString().match(/^\s*$/)) {
                    if ((f.isSelect && !f.multiple && f.itemsArray.length > 0 && f.remove(f.itemsArray[0]), "string" == typeof b && "INPUT" === this.$element[0].tagName)) {
                        var g = b.split(",");
                        if (g.length > 1) {
                            for (var h = 0; h < g.length; h++) this.add(g[h], !0);
                            return void (c || f.pushVal());
                        }
                    }
                    var i = f.options.itemValue(b),
                        j = f.options.itemText(b),
                        k = f.options.tagClass(b),
                        l = f.options.itemTitle(b),
                        m = a.grep(f.itemsArray, function (a) {
                            return f.options.itemValue(a) === i;
                        })[0];
                    if (!m || f.options.allowDuplicates) {
                        if (!(f.items().toString().length + b.length + 1 > f.options.maxInputLength)) {
                            var n = a.Event("beforeItemAdd", { item: b, cancel: !1, options: d });
                            if ((f.$element.trigger(n), !n.cancel)) {
                                f.itemsArray.push(b);
                                var o = a('<span class="tag ' + e(k) + (null !== l ? '" title="' + l : "") + '">' + e(j) + '<span data-role="remove"></span></span>');
                                if ((o.data("item", b), f.findInputWrapper().before(o), o.after(" "), f.isSelect && !a('option[value="' + encodeURIComponent(i) + '"]', f.$element)[0])) {
                                    var p = a("<option selected>" + e(j) + "</option>");
                                    p.data("item", b), p.attr("value", i), f.$element.append(p);
                                }
                                c || f.pushVal(),
                                    (f.options.maxTags === f.itemsArray.length || f.items().toString().length === f.options.maxInputLength) && f.$container.addClass("bootstrap-tagsinput-max"),
                                    f.$element.trigger(a.Event("itemAdded", { item: b, options: d }));
                            }
                        }
                    } else if (f.options.onTagExists) {
                        var q = a(".tag", f.$container).filter(function () {
                            return a(this).data("item") === m;
                        });
                        f.options.onTagExists(b, q);
                    }
                }
            }
        },
        remove: function (b, c, d) {
            var e = this;
            if (
                (e.objectItems &&
                    ((b =
                        "object" == typeof b
                            ? a.grep(e.itemsArray, function (a) {
                                  return e.options.itemValue(a) == e.options.itemValue(b);
                              })
                            : a.grep(e.itemsArray, function (a) {
                                  return e.options.itemValue(a) == b;
                              })),
                    (b = b[b.length - 1])),
                b)
            ) {
                var f = a.Event("beforeItemRemove", { item: b, cancel: !1, options: d });
                if ((e.$element.trigger(f), f.cancel)) return;
                a(".tag", e.$container)
                    .filter(function () {
                        return a(this).data("item") === b;
                    })
                    .remove(),
                    a("option", e.$element)
                        .filter(function () {
                            return a(this).data("item") === b;
                        })
                        .remove(),
                    -1 !== a.inArray(b, e.itemsArray) && e.itemsArray.splice(a.inArray(b, e.itemsArray), 1);
            }
            c || e.pushVal(), e.options.maxTags > e.itemsArray.length && e.$container.removeClass("bootstrap-tagsinput-max"), e.$element.trigger(a.Event("itemRemoved", { item: b, options: d }));
        },
        removeAll: function () {
            var b = this;
            for (a(".tag", b.$container).remove(), a("option", b.$element).remove(); b.itemsArray.length > 0; ) b.itemsArray.pop();
            b.pushVal();
        },
        refresh: function () {
            var b = this;
            a(".tag", b.$container).each(function () {
                var c = a(this),
                    d = c.data("item"),
                    f = b.options.itemValue(d),
                    g = b.options.itemText(d),
                    h = b.options.tagClass(d);
                if (
                    (c.attr("class", null),
                    c.addClass("tag " + e(h)),
                    (c.contents().filter(function () {
                        return 3 == this.nodeType;
                    })[0].nodeValue = e(g)),
                    b.isSelect)
                ) {
                    var i = a("option", b.$element).filter(function () {
                        return a(this).data("item") === d;
                    });
                    i.attr("value", f);
                }
            });
        },
        items: function () {
            return this.itemsArray;
        },
        pushVal: function () {
            var b = this,
                c = a.map(b.items(), function (a) {
                    return b.options.itemValue(a).toString();
                });
            b.$element.val(c, !0).trigger("change");
        },
        build: function (b) {
            var e = this;
            if (((e.options = a.extend({}, h, b)), e.objectItems && (e.options.freeInput = !1), c(e.options, "itemValue"), c(e.options, "itemText"), d(e.options, "tagClass"), e.options.typeahead)) {
                var i = e.options.typeahead || {};
                d(i, "source"),
                    e.$input.typeahead(
                        a.extend({}, i, {
                            source: function (b, c) {
                                function d(a) {
                                    for (var b = [], d = 0; d < a.length; d++) {
                                        var g = e.options.itemText(a[d]);
                                        (f[g] = a[d]), b.push(g);
                                    }
                                    c(b);
                                }
                                this.map = {};
                                var f = this.map,
                                    g = i.source(b);
                                a.isFunction(g.success) ? g.success(d) : a.isFunction(g.then) ? g.then(d) : a.when(g).then(d);
                            },
                            updater: function (a) {
                                return e.add(this.map[a]), this.map[a];
                            },
                            matcher: function (a) {
                                return -1 !== a.toLowerCase().indexOf(this.query.trim().toLowerCase());
                            },
                            sorter: function (a) {
                                return a.sort();
                            },
                            highlighter: function (a) {
                                var b = new RegExp("(" + this.query + ")", "gi");
                                return a.replace(b, "<strong>$1</strong>");
                            },
                        })
                    );
            }
            if (e.options.typeaheadjs) {
                var j = null,
                    k = {},
                    l = e.options.typeaheadjs;
                a.isArray(l) ? ((j = l[0]), (k = l[1])) : (k = l),
                    e.$input.typeahead(j, k).on(
                        "typeahead:selected",
                        a.proxy(function (a, b) {
                            e.add(k.valueKey ? b[k.valueKey] : b), e.$input.typeahead("val", "");
                        }, e)
                    );
            }
            e.$container.on(
                "click",
                a.proxy(function () {
                    e.$element.attr("disabled") || e.$input.removeAttr("disabled"), e.$input.focus();
                }, e)
            ),
                e.options.addOnBlur &&
                    e.options.freeInput &&
                    e.$input.on(
                        "focusout",
                        a.proxy(function () {
                            0 === a(".typeahead, .twitter-typeahead", e.$container).length && (e.add(e.$input.val()), e.$input.val(""));
                        }, e)
                    ),
                e.$container.on(
                    "keydown",
                    "input",
                    a.proxy(function (b) {
                        var c = a(b.target),
                            d = e.findInputWrapper();
                        if (e.$element.attr("disabled")) return void e.$input.attr("disabled", "disabled");
                        switch (b.which) {
                            case 8:
                                if (0 === f(c[0])) {
                                    var g = d.prev();
                                    g && e.remove(g.data("item"));
                                }
                                break;
                            case 46:
                                if (0 === f(c[0])) {
                                    var h = d.next();
                                    h && e.remove(h.data("item"));
                                }
                                break;
                            case 37:
                                var i = d.prev();
                                0 === c.val().length && i[0] && (i.before(d), c.focus());
                                break;
                            case 39:
                                var j = d.next();
                                0 === c.val().length && j[0] && (j.after(d), c.focus());
                        }
                        {
                            var k = c.val().length;
                            Math.ceil(k / 5);
                        }
                        c.attr("size", Math.max(this.inputSize, c.val().length));
                    }, e)
                ),
                e.$container.on(
                    "keypress",
                    "input",
                    a.proxy(function (b) {
                        var c = a(b.target);
                        if (e.$element.attr("disabled")) return void e.$input.attr("disabled", "disabled");
                        var d = c.val(),
                            f = e.options.maxChars && d.length >= e.options.maxChars;
                        e.options.freeInput && (g(b, e.options.confirmKeys) || f) && (e.add(f ? d.substr(0, e.options.maxChars) : d), c.val(""), b.preventDefault());
                        {
                            var h = c.val().length;
                            Math.ceil(h / 5);
                        }
                        c.attr("size", Math.max(this.inputSize, c.val().length));
                    }, e)
                ),
                e.$container.on(
                    "click",
                    "[data-role=remove]",
                    a.proxy(function (b) {
                        e.$element.attr("disabled") || e.remove(a(b.target).closest(".tag").data("item"));
                    }, e)
                ),
                e.options.itemValue === h.itemValue &&
                    ("INPUT" === e.$element[0].tagName
                        ? e.add(e.$element.val())
                        : a("option", e.$element).each(function () {
                              e.add(a(this).attr("value"), !0);
                          }));
        },
        destroy: function () {
            var a = this;
            a.$container.off("keypress", "input"), a.$container.off("click", "[role=remove]"), a.$container.remove(), a.$element.removeData("tagsinput"), a.$element.show();
        },
        focus: function () {
            this.$input.focus();
        },
        input: function () {
            return this.$input;
        },
        findInputWrapper: function () {
            for (var b = this.$input[0], c = this.$container[0]; b && b.parentNode !== c; ) b = b.parentNode;
            return a(b);
        },
    }),
        (a.fn.tagsinput = function (c, d, e) {
            var f = [];
            return (
                this.each(function () {
                    var g = a(this).data("tagsinput");
                    if (g)
                        if (c || d) {
                            if (void 0 !== g[c]) {
                                if (3 === g[c].length && void 0 !== e) var h = g[c](d, null, e);
                                else var h = g[c](d);
                                void 0 !== h && f.push(h);
                            }
                        } else f.push(g);
                    else (g = new b(this, c)), a(this).data("tagsinput", g), f.push(g), "SELECT" === this.tagName && a("option", a(this)).attr("selected", "selected"), a(this).val(a(this).val());
                }),
                "string" == typeof c ? (f.length > 1 ? f : f[0]) : f
            );
        }),
        (a.fn.tagsinput.Constructor = b);
    var i = a("<div />");
    a(function () {
        a("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
    });
})(window.jQuery);

//# sourceMappingURL=bootstrap-tagsinput.min.js.map