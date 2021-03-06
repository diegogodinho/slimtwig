﻿/*
 * jQuery wizard plug-in 3.0.7 (18-SEPT-2012)
 *
 *
 * Copyright (c) 2012 Jan Sundman (jan.sundman[at]aland.net)
 *
 * http://www.thecodemine.org
 *
 * Licensed under the MIT licens:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 */
(function (e) {
    e.widget("ui.formwizard", {
        _init: function () {
            var t = this,
                n = this.options.formOptions.success,
                r = this.options.formOptions.complete,
                i = this.options.formOptions.beforeSend,
                s = this.options.formOptions.beforeSubmit,
                o = this.options.formOptions.beforeSerialize;
            this.options.formOptions = e.extend(this.options.formOptions, {
                success: function (e, r, i) {
                    n && n(e, r, i);
                    (t.options.formOptions && t.options.formOptions.resetForm || !t.options.formOptions) && t._reset()
                },
                complete: function (e, n) {
                    r && r(e, n);
                    t._enableNavigation()
                },
                beforeSubmit: function (e, n, r) {
                    if (s) {
                        var i = s(e, n, r);
                        i || t._enableNavigation();
                        return i
                    }
                },
                beforeSend: function (e) {
                    if (i) {
                        var n = i(e);
                        n || t._enableNavigation();
                        return n
                    }
                },
                beforeSerialize: function (e, n) {
                    if (o) {
                        var r = o(e, n);
                        r || t._enableNavigation();
                        return r
                    }
                }
            });
            this.options.historyEnabled && e.bbq.removeState("_" + e(this.element).attr("id"));
            this.steps = this.element.find(".step").hide();
            this.firstStep = this.steps.eq(0).attr("id");
            this.activatedSteps = new Array;
            this.isLastStep = !1;
            this.previousStep = undefined;
            this.currentStep = this.steps.eq(0).attr("id");
            this.nextButton = this.element.find(this.options.next).click(function () {
                return t._next()
            });
            this.nextButtonInitinalValue = this.nextButton.val();
            this.nextButton.val(this.options.textNext);
            this.backButton = this.element.find(this.options.back).click(function () {
                t._back();
                return !1
            });
            this.backButtonInitinalValue = this.backButton.val();
            this.backButton.val(this.options.textBack);
            if (this.options.validationEnabled && jQuery().validate == undefined) {
                this.options.validationEnabled = !1;
                window.console !== undefined && console.log("%s", "validationEnabled option set, but the validation plugin is not included")
            } else this.options.validationEnabled && this.element.validate(this.options.validationOptions);
            if (this.options.formPluginEnabled && jQuery().ajaxSubmit == undefined) {
                this.options.formPluginEnabled = !1;
                window.console !== undefined && console.log("%s", "formPluginEnabled option set but the form plugin is not included")
            }
            this.options.disableInputFields == 1 && e(this.steps).find(":input:not('.wizard-ignore')").attr("disabled", "disabled");
            this.options.historyEnabled && e(window).bind("hashchange", undefined, function (n) {
                var r = n.getState("_" + e(t.element).attr("id")) || t.firstStep;
                if (r !== t.currentStep) {
                    if (t.options.validationEnabled && r === t._navigate(t.currentStep) && !t.element.valid()) {
                        t._updateHistory(t.currentStep);
                        t.element.validate().focusInvalid();
                        return !1
                    }
                    r !== t.currentStep && t._show(r)
                }
            });
            this.element.addClass("ui-formwizard");
            this.element.find(":input").addClass("ui-wizard-content");
            this.steps.addClass("ui-formwizard-content");
            this.backButton.addClass("ui-formwizard-button ui-wizard-content");
            this.nextButton.addClass("ui-formwizard-button ui-wizard-content");
            if (!this.options.disableUIStyles) {
                this.element.addClass("ui-helper-reset ui-widget ui-widget-content ui-helper-reset ui-corner-all");
                this.element.find(":input").addClass("ui-helper-reset ui-state-default");
                this.steps.addClass("ui-helper-reset ui-corner-all");
                this.backButton.addClass("ui-helper-reset ui-state-default");
                this.nextButton.addClass("ui-helper-reset ui-state-default")
            }
            this._show(undefined);
            return e(this)
        },
        _next: function () {
            if (this.options.validationEnabled && !this.element.valid()) {
                this.element.validate().focusInvalid();
                return !1
            }
            if (this.options.remoteAjax != undefined) {
                var t = this.options.remoteAjax[this.currentStep],
                    n = this;
                if (t !== undefined) {
                    var r = t.success,
                        i = t.beforeSend,
                        s = t.complete;
                    t = e.extend({}, t, {
                        success: function (e, t) {
                            (r !== undefined && r(e, t) || r == undefined) && n._continueToNextStep()
                        },
                        beforeSend: function (t) {
                            n._disableNavigation();
                            i !== undefined && i(t);
                            e(n.element).trigger("before_remote_ajax", {
                                currentStep: n.currentStep
                            })
                        },
                        complete: function (t, r) {
                            s !== undefined && s(t, r);
                            e(n.element).trigger("after_remote_ajax", {
                                currentStep: n.currentStep
                            });
                            n._enableNavigation()
                        }
                    });
                    this.element.ajaxSubmit(t);
                    return !1
                }
            }
            return this._continueToNextStep()
        },
        _back: function () {
            this.activatedSteps.length > 0 && (this.options.historyEnabled ? this._updateHistory(this.activatedSteps[this.activatedSteps.length - 2]) : this._show(this.activatedSteps[this.activatedSteps.length - 2], !0));
            return !1
        },
        _continueToNextStep: function () {
            if (this.isLastStep) {
                for (var e = 0; e < this.activatedSteps.length; e++) this.steps.filter("#" + this.activatedSteps[e]).find(":input").not(".wizard-ignore").removeAttr("disabled");
                if (!this.options.formPluginEnabled) return !0;
                this._disableNavigation();
                this.element.ajaxSubmit(this.options.formOptions);
                return !1
            }
            var t = this._navigate(this.currentStep);
            if (t == this.currentStep) return !1;
            this.options.historyEnabled ? this._updateHistory(t) : this._show(t, !0);
            return !1
        },
        _updateHistory: function (t) {
            var n = {};
            n["_" + e(this.element).attr("id")] = t;
            e.bbq.pushState(n)
        },
        _disableNavigation: function () {
            this.nextButton.attr("disabled", "disabled");
            this.backButton.attr("disabled", "disabled");
            if (!this.options.disableUIStyles) {
                this.nextButton.removeClass("ui-state-active").addClass("ui-state-disabled");
                this.backButton.removeClass("ui-state-active").addClass("ui-state-disabled")
            }
        },
        _enableNavigation: function () {
            this.isLastStep ? this.nextButton.val(this.options.textSubmit) : this.nextButton.val(this.options.textNext);
            if (e.trim(this.currentStep) !== this.steps.eq(0).attr("id")) {
                this.backButton.removeAttr("disabled");
                this.options.disableUIStyles || this.backButton.removeClass("ui-state-disabled").addClass("ui-state-active")
            }
            this.nextButton.removeAttr("disabled");
            this.options.disableUIStyles || this.nextButton.removeClass("ui-state-disabled").addClass("ui-state-active")
        },
        _animate: function (e, t, n) {
            this._disableNavigation();
            var r = this.steps.filter("#" + e),
                i = this.steps.filter("#" + t);
            r.find(":input").not(".wizard-ignore").attr("disabled", "disabled");
            i.find(":input").not(".wizard-ignore").removeAttr("disabled");
            var s = this;
            r.animate(s.options.outAnimation, s.options.outDuration, s.options.easing, function () {
                i.animate(s.options.inAnimation, s.options.inDuration, s.options.easing, function () {
                    s.options.focusFirstInput && i.find(":input:first").focus();
                    s._enableNavigation();
                    n.apply(s)
                });
                return
            })
        },
        _checkIflastStep: function (t) {
            this.isLastStep = !1;
            if (e("#" + t).hasClass(this.options.submitStepClass) || this.steps.filter(":last").attr("id") == t) this.isLastStep = !0
        },
        _getLink: function (t) {
            var n = undefined,
                r = this.steps.filter("#" + t).find(this.options.linkClass);
            r != undefined && (r.filter(":radio,:checkbox").size() > 0 ? n = r.filter(this.options.linkClass + ":checked").val() : n = e(r).val());
            return n
        },
        _navigate: function (e) {
            var t = this._getLink(e);
            if (t != undefined) return t != "" && t != null && t != undefined && this.steps.filter("#" + t).attr("id") != undefined ? t : this.currentStep;
            if (t == undefined && !this.isLastStep) {
                var n = this.steps.filter("#" + e).next().attr("id");
                return n
            }
        },
        _show: function (t) {
            var n = !1,
                r = t !== undefined;
            if (t == undefined || t == "") {
                this.activatedSteps.pop();
                t = this.firstStep;
                this.activatedSteps.push(t)
            } else if (e.inArray(t, this.activatedSteps) > -1) {
                n = !0;
                this.activatedSteps.pop()
            } else this.activatedSteps.push(t);
            if (this.currentStep !== t || t === this.firstStep) {
                this.previousStep = this.currentStep;
                this._checkIflastStep(t);
                this.currentStep = t;
                var i = function () {
                    r && e(this.element).trigger("step_shown", e.extend({
                        isBackNavigation: n
                    }, this._state()))
                };
                r && e(this.element).trigger("before_step_shown", e.extend({
                    isBackNavigation: n
                }, this._state()));
                this._animate(this.previousStep, t, i)
            }
        },
        _reset: function () {
            this.element.resetForm();
            e("label,:input,textarea", this).removeClass("error");
            for (var t = 0; t < this.activatedSteps.length; t++) this.steps.filter("#" + this.activatedSteps[t]).hide().find(":input").attr("disabled", "disabled");
            this.activatedSteps = new Array;
            this.previousStep = undefined;
            this.isLastStep = !1;
            this.options.historyEnabled ? this._updateHistory(this.firstStep) : this._show(this.firstStep)
        },
        _state: function (e) {
            var t = {
                settings: this.options,
                activatedSteps: this.activatedSteps,
                isLastStep: this.isLastStep,
                isFirstStep: this.currentStep === this.firstStep,
                previousStep: this.previousStep,
                currentStep: this.currentStep,
                backButton: this.backButton,
                nextButton: this.nextButton,
                steps: this.steps,
                firstStep: this.firstStep
            };
            return e !== undefined ? t[e] : t
        },
        show: function (e) {
            this.options.historyEnabled ? this._updateHistory(e) : this._show(e)
        },
        state: function (e) {
            return this._state(e)
        },
        reset: function () {
            this._reset()
        },
        next: function () {
            this._next()
        },
        back: function () {
            this._back()
        },
        destroy: function () {
            this.element.find("*").removeAttr("disabled").show();
            this.nextButton.unbind("click").val(this.nextButtonInitinalValue).removeClass("ui-state-disabled").addClass("ui-state-active");
            this.backButton.unbind("click").val(this.backButtonInitinalValue).removeClass("ui-state-disabled").addClass("ui-state-active");
            this.backButtonInitinalValue = undefined;
            this.nextButtonInitinalValue = undefined;
            this.activatedSteps = undefined;
            this.previousStep = undefined;
            this.currentStep = undefined;
            this.isLastStep = undefined;
            this.options = undefined;
            this.nextButton = undefined;
            this.backButton = undefined;
            this.formwizard = undefined;
            this.element = undefined;
            this.steps = undefined;
            this.firstStep = undefined
        },
        update_steps: function () {
            this.steps = this.element.find(".step").addClass("ui-formwizard-content");
            this.firstStep = this.steps.eq(0).attr("id");
            this.steps.not("#" + this.currentStep).hide().find(":input").addClass("ui-wizard-content").attr("disabled", "disabled");
            this._checkIflastStep(this.currentStep);
            this._enableNavigation();
            if (!this.options.disableUIStyles) {
                this.steps.addClass("ui-helper-reset ui-corner-all");
                this.steps.find(":input").addClass("ui-helper-reset ui-state-default")
            }
        },
        options: {
            historyEnabled: !1,
            validationEnabled: !1,
            validationOptions: undefined,
            formPluginEnabled: !1,
            linkClass: ".link",
            submitStepClass: "submit_step",
            back: ":reset",
            next: ":submit",
            textSubmit: "Confirmar",
            textNext: "Próximo",
            textBack: "Anterior",
            remoteAjax: undefined,
            inAnimation: {
                opacity: "show"
            },
            outAnimation: {
                opacity: "hide"
            },
            inDuration: 400,
            outDuration: 400,
            easing: "swing",
            focusFirstInput: !1,
            disableInputFields: !0,
            formOptions: {
                reset: !0,
                success: function (e) {
                    window.console !== undefined && console.log("%s", "form submit successful")
                },
                disableUIStyles: !1
            }
        }
    })
})(jQuery);