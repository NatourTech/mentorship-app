/* jqBootstrapValidation
 * A plugin for automating validation on Twitter Bootstrap formatted forms.
 * v1.3.6
 */
!(function (a) {
    "use strict"; 

    var e = [],
        t = {
            options: {
                prependExistingHelpBlock: !1,
                sniffHtml: !0,
                preventSubmit: !0,
                submitError: !1,
                submitSuccess: !1,
                semanticallyStrict: !1,
                bindEvents: [],
                autoAdd: { helpBlocks: !0 },
                filter: function () {
                    return !0;
                },
            },
            methods: {
                init: function (r) {
                    var o = a.extend(!0, {}, t);
                    o.options = a.extend(!0, o.options, r);
                    var s = a.unique(
                        this.map(function () {
                            return a(this).parents("form")[0];
                        }).toArray()
                    );
                    return (
                        a(s).bind("submit.validationSubmit", function (e) {
                            var t = a(this),
                                i = 0,
                                n = t.find("input,textarea,select").not("[type=submit],[type=image]").filter(o.options.filter),
                                r = t.find(".form-group"),
                                s = n.filter(function () {
                                    return a(this).triggerHandler("getValidatorCount.validation") > 0;
                                });
                            s.trigger("submit.validation"),
                                n.trigger("validationLostFocus.validation"),
                                r.each(function (e, t) {
                                    var n = a(t);
                                    (n.hasClass("issue") || n.hasClass("error")) && (n.removeClass("issue").addClass("error"), i++);
                                }),
                                i
                                    ? (o.options.preventSubmit && (e.preventDefault(), e.stopImmediatePropagation()),
                                      t.addClass("error"),
                                      a.isFunction(o.options.submitError) && o.options.submitError(t, e, s.jqBootstrapValidation("collectErrors", !0)))
                                    : (t.removeClass("error"), a.isFunction(o.options.submitSuccess) && o.options.submitSuccess(t, e));
                        }),
                        this.each(function () {
                            var t = a(this),
                                r = t.parents(".form-group").first(),
                                s = r.find(".help-block").first(),
                                d = t.parents("form").first(),
                                l = [];
                            if ((!s.length && o.options.autoAdd && o.options.autoAdd.helpBlocks && ((s = a('<div class="help-block" />')), r.find(".controls").append(s), e.push(s[0])), o.options.sniffHtml)) {
                                var v;
                                if (
                                    (t.data("validationPatternPattern") && t.attr("pattern", t.data("validationPatternPattern")),
                                    void 0 !== t.attr("pattern") &&
                                        ((v = "Not in the expected format\x3c!-- data-validation-pattern-message to override --\x3e"),
                                        t.data("validationPatternMessage") && (v = t.data("validationPatternMessage")),
                                        t.data("validationPatternMessage", v),
                                        t.data("validationPatternRegex", t.attr("pattern"))),
                                    void 0 !== t.attr("max") || void 0 !== t.attr("aria-valuemax"))
                                ) {
                                    var m = void 0 !== t.attr("max") ? t.attr("max") : t.attr("aria-valuemax");
                                    (v = "Too high: Maximum of '" + m + "'\x3c!-- data-validation-max-message to override --\x3e"),
                                        t.data("validationMaxMessage") && (v = t.data("validationMaxMessage")),
                                        t.data("validationMaxMessage", v),
                                        t.data("validationMaxMax", m);
                                }
                                if (void 0 !== t.attr("min") || void 0 !== t.attr("aria-valuemin")) {
                                    var c = void 0 !== t.attr("min") ? t.attr("min") : t.attr("aria-valuemin");
                                    (v = "Too low: Minimum of '" + c + "'\x3c!-- data-validation-min-message to override --\x3e"),
                                        t.data("validationMinMessage") && (v = t.data("validationMinMessage")),
                                        t.data("validationMinMessage", v),
                                        t.data("validationMinMin", c);
                                }
                                if (
                                    (void 0 !== t.attr("maxlength") &&
                                        ((v = "Too long: Maximum of '" + t.attr("maxlength") + "' characters\x3c!-- data-validation-maxlength-message to override --\x3e"),
                                        t.data("validationMaxlengthMessage") && (v = t.data("validationMaxlengthMessage")),
                                        t.data("validationMaxlengthMessage", v),
                                        t.data("validationMaxlengthMaxlength", t.attr("maxlength"))),
                                    void 0 !== t.attr("minlength") &&
                                        ((v = "Too short: Minimum of '" + t.attr("minlength") + "' characters\x3c!-- data-validation-minlength-message to override --\x3e"),
                                        t.data("validationMinlengthMessage") && (v = t.data("validationMinlengthMessage")),
                                        t.data("validationMinlengthMessage", v),
                                        t.data("validationMinlengthMinlength", t.attr("minlength"))),
                                    (void 0 === t.attr("required") && void 0 === t.attr("aria-required")) ||
                                        ((v = o.builtInValidators.required.message), t.data("validationRequiredMessage") && (v = t.data("validationRequiredMessage")), t.data("validationRequiredMessage", v)),
                                    void 0 !== t.attr("type") && "number" === t.attr("type").toLowerCase())
                                ) {
                                    (v = o.validatorTypes.number.message), t.data("validationNumberMessage") && (v = t.data("validationNumberMessage")), t.data("validationNumberMessage", v);
                                    var u = o.validatorTypes.number.step;
                                    t.data("validationNumberStep") && (u = t.data("validationNumberStep")), t.data("validationNumberStep", u);
                                    var g = o.validatorTypes.number.decimal;
                                    t.data("validationNumberDecimal") && (g = t.data("validationNumberDecimal")), t.data("validationNumberDecimal", g);
                                }
                                void 0 !== t.attr("type") &&
                                    "email" === t.attr("type").toLowerCase() &&
                                    ((v = "Not a valid email address\x3c!-- data-validation-email-message to override --\x3e"),
                                    t.data("validationEmailMessage") && (v = t.data("validationEmailMessage")),
                                    t.data("validationEmailMessage", v)),
                                    void 0 !== t.attr("minchecked") &&
                                        ((v = "Not enough options checked; Minimum of '" + t.attr("minchecked") + "' required\x3c!-- data-validation-minchecked-message to override --\x3e"),
                                        t.data("validationMincheckedMessage") && (v = t.data("validationMincheckedMessage")),
                                        t.data("validationMincheckedMessage", v),
                                        t.data("validationMincheckedMinchecked", t.attr("minchecked"))),
                                    void 0 !== t.attr("maxchecked") &&
                                        ((v = "Too many options checked; Maximum of '" + t.attr("maxchecked") + "' required\x3c!-- data-validation-maxchecked-message to override --\x3e"),
                                        t.data("validationMaxcheckedMessage") && (v = t.data("validationMaxcheckedMessage")),
                                        t.data("validationMaxcheckedMessage", v),
                                        t.data("validationMaxcheckedMaxchecked", t.attr("maxchecked")));
                            }
                            void 0 !== t.data("validation") && (l = t.data("validation").split(",")),
                                a.each(t.data(), function (a, e) {
                                    var t = a.replace(/([A-Z])/g, ",$1").split(",");
                                    "validation" === t[0] && t[1] && l.push(t[1]);
                                });
                            var h = l,
                                p = [],
                                f = function (a, e) {
                                    l[a] = i(e);
                                },
                                x = function (e, n) {
                                    if (void 0 !== t.data("validation" + n + "Shortcut"))
                                        a.each(t.data("validation" + n + "Shortcut").split(","), function (a, e) {
                                            p.push(e);
                                        });
                                    else if (o.builtInValidators[n.toLowerCase()]) {
                                        var r = o.builtInValidators[n.toLowerCase()];
                                        "shortcut" === r.type.toLowerCase() &&
                                            a.each(r.shortcut.split(","), function (a, e) {
                                                (e = i(e)), p.push(e), l.push(e);
                                            });
                                    }
                                };
                            do {
                                a.each(l, f), (l = a.unique(l)), (p = []), a.each(h, x), (h = p);
                            } while (h.length > 0);
                            var b = {};
                            a.each(l, function (e, n) {
                                var r = t.data("validation" + n + "Message"),
                                    s = !!r,
                                    d = !1;
                                if (
                                    (r || (r = "'" + n + "' validation failed \x3c!-- Add attribute 'data-validation-" + n.toLowerCase() + "-message' to input to change this message --\x3e"),
                                    a.each(o.validatorTypes, function (e, o) {
                                        if ((void 0 === b[e] && (b[e] = []), !d && void 0 !== t.data("validation" + n + i(o.name)))) {
                                            var l = o.init(t, n);
                                            s && (l.message = r), b[e].push(a.extend(!0, { name: i(o.name), message: r }, l)), (d = !0);
                                        }
                                    }),
                                    !d && o.builtInValidators[n.toLowerCase()])
                                ) {
                                    var l = a.extend(!0, {}, o.builtInValidators[n.toLowerCase()]);
                                    s && (l.message = r);
                                    var v = l.type.toLowerCase();
                                    "shortcut" === v
                                        ? (d = !0)
                                        : a.each(o.validatorTypes, function (e, r) {
                                              void 0 === b[e] && (b[e] = []), d || v !== e.toLowerCase() || (t.data("validation" + n + i(r.name), l[r.name.toLowerCase()]), b[v].push(a.extend(l, r.init(t, n))), (d = !0));
                                          });
                                }
                                d || a.error("Cannot find validation info for '" + n + "'");
                            }),
                                s.data("original-contents", s.data("original-contents") ? s.data("original-contents") : s.html()),
                                s.data("original-role", s.data("original-role") ? s.data("original-role") : s.attr("role")),
                                r.data("original-classes", r.data("original-clases") ? r.data("original-classes") : r.attr("class")),
                                t.data("original-aria-invalid", t.data("original-aria-invalid") ? t.data("original-aria-invalid") : t.attr("aria-invalid")),
                                t.bind("validation.validation", function (e, i) {
                                    var r = n(t),
                                        s = [];
                                    return (
                                        a.each(b, function (e, n) {
                                            (r || r.length || (i && i.includeEmpty) || o.validatorTypes[e].includeEmpty || (o.validatorTypes[e].blockSubmit && i && i.submitting)) &&
                                                a.each(n, function (a, i) {
                                                    o.validatorTypes[e].validate(t, r, i) && s.push(i.message);
                                                });
                                        }),
                                        s
                                    );
                                }),
                                t.bind("getValidators.validation", function () {
                                    return b;
                                });
                            var M = 0;
                            a.each(b, function (a, e) {
                                M += e.length;
                            }),
                                t.bind("getValidatorCount.validation", function () {
                                    return M;
                                }),
                                t.bind("submit.validation", function () {
                                    return t.triggerHandler("change.validation", { submitting: !0 });
                                }),
                                t.bind((o.options.bindEvents.length > 0 ? o.options.bindEvents : ["keyup", "focus", "blur", "click", "keydown", "keypress", "change"]).concat(["revalidate"]).join(".validation ") + ".validation", function (
                                    e,
                                    i
                                ) {
                                    var l = n(t),
                                        v = [];
                                    i && i.submitting ? r.data("jqbvIsSubmitting", !0) : "revalidate" !== e.type && r.data("jqbvIsSubmitting", !1);
                                    var m = !!r.data("jqbvIsSubmitting");
                                    r
                                        .find("input,textarea,select")
                                        .not("[type=submit]")
                                        .each(function (e, n) {
                                            var r = v.length;
                                            if (
                                                (a.each(a(n).triggerHandler("validation.validation", i) || [], function (a, e) {
                                                    v.push(e);
                                                }),
                                                v.length > r)
                                            )
                                                a(n).attr("aria-invalid", "true");
                                            else {
                                                var o = t.data("original-aria-invalid");
                                                a(n).attr("aria-invalid", void 0 !== o && o);
                                            }
                                        }),
                                        d
                                            .find("input,select,textarea")
                                            .not(t)
                                            .not('[name="' + t.attr("name") + '"]')
                                            .trigger("validationLostFocus.validation"),
                                        (v = a.unique(v.sort())).length
                                            ? (r.removeClass("validate error issue").addClass(m ? "error" : "issue"),
                                              o.options.semanticallyStrict && 1 === v.length
                                                  ? s.html(v[0] + (o.options.prependExistingHelpBlock ? s.data("original-contents") : ""))
                                                  : s.html('<ul role="alert"><li>' + v.join("</li><li>") + "</li></ul>" + (o.options.prependExistingHelpBlock ? s.data("original-contents") : "")))
                                            : (r.removeClass("issue error validate"), l.length > 0 && r.addClass("validate"), s.html(s.data("original-contents"))),
                                        "blur" === e.type && o.options.removeSuccess;
                                }),
                                t.bind("validationLostFocus.validation", function () {
                                    o.options.removeSuccess;
                                });
                        })
                    );
                },
                destroy: function () {
                    return this.each(function () {
                        var t = a(this),
                            i = t.parents(".form-group").first(),
                            n = i.find(".help-block").first(),
                            r = t.parents("form").first();
                        t.unbind(".validation"),
                            r.unbind(".validationSubmit"),
                            n.html(n.data("original-contents")),
                            i.attr("class", i.data("original-classes")),
                            t.attr("aria-invalid", t.data("original-aria-invalid")),
                            n.attr("role", t.data("original-role")),
                            a.inArray(n[0], e) > -1 && n.remove();
                    });
                },
                collectErrors: function (e) {
                    var t = {};
                    return (
                        this.each(function (e, i) {
                            var n = a(i),
                                r = n.attr("name"),
                                o = n.triggerHandler("validation.validation", { includeEmpty: !0 });
                            t[r] = a.extend(!0, o, t[r]);
                        }),
                        a.each(t, function (a, e) {
                            0 === e.length && delete t[a];
                        }),
                        t
                    );
                },
                hasErrors: function () {
                    var e = [];
                    return (
                        this.find("input,select,textarea")
                            .add(this)
                            .each(function (t, i) {
                                e = e.concat(a(i).triggerHandler("getValidators.validation") ? a(i).triggerHandler("validation.validation", { submitting: !0 }) : []);
                            }),
                        e.length > 0
                    );
                },
                override: function (e) {
                    t = a.extend(!0, t, e);
                },
            },
            validatorTypes: {
                callback: {
                    name: "callback",
                    init: function (a, e) {
                        var t = { validatorName: e, callback: a.data("validation" + e + "Callback"), lastValue: a.val(), lastValid: !0, lastFinished: !0 },
                            i = "Not valid";
                        return a.data("validation" + e + "Message") && (i = a.data("validation" + e + "Message")), (t.message = i), t;
                    },
                    validate: function (a, e, t) {
                        if (t.lastValue === e && t.lastFinished) return !t.lastValid;
                        if (!0 === t.lastFinished) {
                            (t.lastValue = e), (t.lastValid = !0), (t.lastFinished = !1);
                            var i = t,
                                n = a;
                            !(function (a, e) {
                                for (var t = Array.prototype.slice.call(arguments, 2), i = a.split("."), n = i.pop(), r = 0; r < i.length; r++) e = e[i[r]];
                                e[n].apply(e, t);
                            })(t.callback, window, a, e, function (e) {
                                i.lastValue === e.value &&
                                    ((i.lastValid = e.valid),
                                    e.message && (i.message = e.message),
                                    (i.lastFinished = !0),
                                    n.data("validation" + i.validatorName + "Message", i.message),
                                    setTimeout(function () {
                                        !a.is(":focus") && a.parents("form").first().data("jqbvIsSubmitting") ? n.trigger("blur.validation") : n.trigger("revalidate.validation");
                                    }, 1));
                            });
                        }
                        return !1;
                    },
                },
                ajax: {
                    name: "ajax",
                    init: function (a, e) {
                        return { validatorName: e, url: a.data("validation" + e + "Ajax"), lastValue: a.val(), lastValid: !0, lastFinished: !0 };
                    },
                    validate: function (e, t, i) {
                        return "" + i.lastValue == "" + t && !0 === i.lastFinished
                            ? !1 === i.lastValid
                            : (!0 === i.lastFinished &&
                                  ((i.lastValue = t),
                                  (i.lastValid = !0),
                                  (i.lastFinished = !1),
                                  a.ajax({
                                      url: i.url,
                                      data: "value=" + encodeURIComponent(t) + "&field=" + e.attr("name"),
                                      dataType: "json",
                                      success: function (a) {
                                          "" + i.lastValue == "" + a.value &&
                                              ((i.lastValid = !!a.valid),
                                              a.message && (i.message = a.message),
                                              (i.lastFinished = !0),
                                              e.data("validation" + i.validatorName + "Message", i.message),
                                              setTimeout(function () {
                                                  e.trigger("revalidate.validation");
                                              }, 1));
                                      },
                                      failure: function () {
                                          (i.lastValid = !0),
                                              (i.message = "ajax call failed"),
                                              (i.lastFinished = !0),
                                              e.data("validation" + i.validatorName + "Message", i.message),
                                              setTimeout(function () {
                                                  e.trigger("revalidate.validation");
                                              }, 1);
                                      },
                                  })),
                              !1);
                    },
                },
                regex: {
                    name: "regex",
                    init: function (e, t) {
                        var i = {},
                            n = e.data("validation" + t + "Regex");
                        (i.regex = r(n)), void 0 === n && a.error("Can't find regex for '" + t + "' validator on '" + e.attr("name") + "'");
                        var o = "Not in the expected format";
                        return e.data("validation" + t + "Message") && (o = e.data("validation" + t + "Message")), (i.message = o), (i.originalName = t), i;
                    },
                    validate: function (a, e, t) {
                        return (!t.regex.test(e) && !t.negative) || (t.regex.test(e) && t.negative);
                    },
                },
                email: {
                    name: "email",
                    init: function (a, e) {
                        var t = {};
                        t.regex = r("[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,4}");
                        var i = "Not a valid email address";
                        return a.data("validation" + e + "Message") && (i = a.data("validation" + e + "Message")), (t.message = i), (t.originalName = e), t;
                    },
                    validate: function (a, e, t) {
                        return (!t.regex.test(e) && !t.negative) || (t.regex.test(e) && t.negative);
                    },
                },
                required: {
                    name: "required",
                    init: function (a, e) {
                        var t = "This is required";
                        return a.data("validation" + e + "Message") && (t = a.data("validation" + e + "Message")), { message: t, includeEmpty: !0 };
                    },
                    validate: function (a, e, t) {
                        return !!((0 === e.length && !t.negative) || (e.length > 0 && t.negative));
                    },
                    blockSubmit: !0,
                },
                match: {
                    name: "match",
                    init: function (e, t) {
                        var i = e.data("validation" + t + "Match"),
                            n = e.parents("form").first(),
                            r = n.find('[name="' + i + '"]').first();
                        r.bind("validation.validation", function () {
                            e.trigger("revalidate.validation", { submitting: !0 });
                        });
                        var o = {};
                        (o.element = r), 0 === r.length && a.error("Can't find field '" + i + "' to match '" + e.attr("name") + "' against in '" + t + "' validator");
                        var s = "Must match",
                            d = null;
                        return (
                            (d = n.find('label[for="' + i + '"]')).length ? (s += " '" + d.text() + "'") : (d = r.parents(".form-group").first().find("label")).length && (s += " '" + d.first().text() + "'"),
                            e.data("validation" + t + "Message") && (s = e.data("validation" + t + "Message")),
                            (o.message = s),
                            o
                        );
                    },
                    validate: function (a, e, t) {
                        return (e !== t.element.val() && !t.negative) || (e === t.element.val() && t.negative);
                    },
                    blockSubmit: !0,
                    includeEmpty: !0,
                },
                max: {
                    name: "max",
                    init: function (a, e) {
                        var t = {};
                        return (t.max = a.data("validation" + e + "Max")), (t.message = "Too high: Maximum of '" + t.max + "'"), a.data("validation" + e + "Message") && (t.message = a.data("validation" + e + "Message")), t;
                    },
                    validate: function (a, e, t) {
                        return (parseFloat(e, 10) > parseFloat(t.max, 10) && !t.negative) || (parseFloat(e, 10) <= parseFloat(t.max, 10) && t.negative);
                    },
                },
                min: {
                    name: "min",
                    init: function (a, e) {
                        var t = {};
                        return (t.min = a.data("validation" + e + "Min")), (t.message = "Too low: Minimum of '" + t.min + "'"), a.data("validation" + e + "Message") && (t.message = a.data("validation" + e + "Message")), t;
                    },
                    validate: function (a, e, t) {
                        return (parseFloat(e) < parseFloat(t.min) && !t.negative) || (parseFloat(e) >= parseFloat(t.min) && t.negative);
                    },
                },
                maxlength: {
                    name: "maxlength",
                    init: function (a, e) {
                        var t = {};
                        return (
                            (t.maxlength = a.data("validation" + e + "Maxlength")),
                            (t.message = "Too long: Maximum of '" + t.maxlength + "' characters"),
                            a.data("validation" + e + "Message") && (t.message = a.data("validation" + e + "Message")),
                            t
                        );
                    },
                    validate: function (a, e, t) {
                        return (e.length > t.maxlength && !t.negative) || (e.length <= t.maxlength && t.negative);
                    },
                },
                minlength: {
                    name: "minlength",
                    init: function (a, e) {
                        var t = {};
                        return (
                            (t.minlength = a.data("validation" + e + "Minlength")),
                            (t.message = "Too short: Minimum of '" + t.minlength + "' characters"),
                            a.data("validation" + e + "Message") && (t.message = a.data("validation" + e + "Message")),
                            t
                        );
                    },
                    validate: function (a, e, t) {
                        return (e.length < t.minlength && !t.negative) || (e.length >= t.minlength && t.negative);
                    },
                },
                maxchecked: {
                    name: "maxchecked",
                    init: function (a, e) {
                        var t = {},
                            i = a
                                .parents("form")
                                .first()
                                .find('[name="' + a.attr("name") + '"]');
                        i.bind("change.validation click.validation", function () {
                            a.trigger("revalidate.validation", { includeEmpty: !0 });
                        }),
                            (t.elements = i),
                            (t.maxchecked = a.data("validation" + e + "Maxchecked"));
                        var n = "Too many: Max '" + t.maxchecked + "' checked";
                        return a.data("validation" + e + "Message") && (n = a.data("validation" + e + "Message")), (t.message = n), t;
                    },
                    validate: function (a, e, t) {
                        return (t.elements.filter(":checked").length > t.maxchecked && !t.negative) || (t.elements.filter(":checked").length <= t.maxchecked && t.negative);
                    },
                    blockSubmit: !0,
                },
                minchecked: {
                    name: "minchecked",
                    init: function (a, e) {
                        var t = {},
                            i = a
                                .parents("form")
                                .first()
                                .find('[name="' + a.attr("name") + '"]');
                        i.bind("change.validation click.validation", function () {
                            a.trigger("revalidate.validation", { includeEmpty: !0 });
                        }),
                            (t.elements = i),
                            (t.minchecked = a.data("validation" + e + "Minchecked"));
                        var n = "Too few: Min '" + t.minchecked + "' checked";
                        return a.data("validation" + e + "Message") && (n = a.data("validation" + e + "Message")), (t.message = n), t;
                    },
                    validate: function (a, e, t) {
                        return (t.elements.filter(":checked").length < t.minchecked && !t.negative) || (t.elements.filter(":checked").length >= t.minchecked && t.negative);
                    },
                    blockSubmit: !0,
                    includeEmpty: !0,
                },
                number: {
                    name: "number",
                    init: function (a, e) {
                        var t = { step: 1 };
                        a.attr("step") && (t.step = a.attr("step")),
                            a.data("validation" + e + "Step") && (t.step = a.data("validation" + e + "Step")),
                            (t.decimal = "."),
                            a.data("validation" + e + "Decimal") && (t.decimal = a.data("validation" + e + "Decimal")),
                            (t.thousands = ""),
                            a.data("validation" + e + "Thousands") && (t.thousands = a.data("validation" + e + "Thousands")),
                            (t.regex = r("([+-]?\\d+(\\" + t.decimal + "\\d+)?)?")),
                            (t.message = "Must be a number");
                        var i = a.data("validation" + e + "Message");
                        return i && (t.message = i), t;
                    },
                    validate: function (a, e, t) {
                        for (var i = e.replace(t.decimal, ".").replace(t.thousands, ""), n = parseFloat(i), r = parseFloat(t.step); r % 1 != 0; ) (r = 10 * parseFloat(r.toPrecision(12))), (n = 10 * parseFloat(n.toPrecision(12)));
                        var o = t.regex.test(e),
                            s = parseFloat(n) % parseFloat(r) == 0,
                            d = !isNaN(parseFloat(i)) && isFinite(i);
                        return !(o && s && d);
                    },
                    message: "Must be a number",
                },
            },
            builtInValidators: {
                email: { name: "Email", type: "email" },
                passwordagain: { name: "Passwordagain", type: "match", match: "password", message: "Does not match the given password\x3c!-- data-validator-paswordagain-message to override --\x3e" },
                positive: { name: "Positive", type: "shortcut", shortcut: "number,positivenumber" },
                negative: { name: "Negative", type: "shortcut", shortcut: "number,negativenumber" },
                integer: { name: "Integer", type: "regex", regex: "[+-]?\\d+", message: "No decimal places allowed\x3c!-- data-validator-integer-message to override --\x3e" },
                positivenumber: { name: "Positivenumber", type: "min", min: 0, message: "Must be a positive number\x3c!-- data-validator-positivenumber-message to override --\x3e" },
                negativenumber: { name: "Negativenumber", type: "max", max: 0, message: "Must be a negative number\x3c!-- data-validator-negativenumber-message to override --\x3e" },
                required: { name: "Required", type: "required", message: "This is required\x3c!-- data-validator-required-message to override --\x3e" },
                checkone: { name: "Checkone", type: "minchecked", minchecked: 1, message: "Check at least one option\x3c!-- data-validation-checkone-message to override --\x3e" },
                number: { name: "Number", type: "number", decimal: ".", step: "1" },
                pattern: { name: "Pattern", type: "regex", message: "Not in expected format" },
            },
        },
        i = function (a) {
            return a.toLowerCase().replace(/(^|\s)([a-z])/g, function (a, e, t) {
                return e + t.toUpperCase();
            });
        },
        n = function (e) {
            var t = null,
                i = e.attr("type");
            if ("checkbox" === i) {
                t = e.is(":checked") ? t : "";
                var n = e.parents("form").first() || e.parents(".form-group").first();
                n &&
                    (t = n
                        .find("input[name='" + e.attr("name") + "']:checked")
                        .map(function (e, t) {
                            return a(t).val();
                        })
                        .toArray()
                        .join(","));
            } else if ("radio" === i) {
                t = a('input[name="' + e.attr("name") + '"]:checked').length > 0 ? e.val() : "";
                var r = e.parents("form").first() || e.parents(".form-group").first();
                r &&
                    (t = r
                        .find("input[name='" + e.attr("name") + "']:checked")
                        .map(function (e, t) {
                            return a(t).val();
                        })
                        .toArray()
                        .join(","));
            } else t = "number" === i ? (e[0].validity.valid ? e.val() : e[0].validity.badInput || e[0].validity.stepMismatch ? "NaN" : "") : e.val();
            return t;
        };
    function r(a) {
        return new RegExp("^" + a + "$");
    }
    (a.fn.jqBootstrapValidation = function (e) {
        return t.methods[e]
            ? t.methods[e].apply(this, Array.prototype.slice.call(arguments, 1))
            : "object" != typeof e && e
            ? (a.error("Method " + e + " does not exist on jQuery.jqBootstrapValidation"), null)
            : t.methods.init.apply(this, arguments);
    }),
        (a.jqBootstrapValidation = function (e) {
            a(":input").not("[type=image],[type=submit]").jqBootstrapValidation.apply(this, arguments);
        });
})(jQuery);
