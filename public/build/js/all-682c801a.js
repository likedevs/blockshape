var Unica = angular.module("Unica", ["templates", "ngMaterial", "angular-storage"], function() {});
Unica.SITE_URL = "http://" + location.host, Unica.SECURE_SITE_URL = "https://" + location.host, Unica.API_URL = Unica.SITE_URL + "/api/v1", Unica.COOKIE_NAME = "unica_nutrition", Unica.config(["$mdThemingProvider", function(e) {
        e.theme("default").foregroundPalette[3] = "rgba(0,0,0,0.76)"
    }]), Unica.STORAGE = "session", Unica.run(["$rootScope", function(e) {
        ! function(e) {
            e.loadingView = !1, e.loadingError = !1, e.$on("$loadingResults", function(t, n) {
                e.loadingView = n
            }), e.$on("$routeChangeStart", function(t, n) {
                n.$$route && n.$$route.resolve && (e.loadingView = !0, e.loadingError = !1)
            }), e.$on("$routeChangeSuccess", function() {
                e.loadingView = !1, e.loadingError = !1
            }), e.$on("$routeChangeError", function() {
                e.loadingView = !1, e.loadingError = !0
            })
        }(e)
    }]),
    function() {
        "use strict";
        angular.safeApply = function(e, t) {
            e[e.$$phase || e.$root.$$phase ? "$eval" : "$apply"](t || function() {})
        }, angular.isMobile = function(e) {
            return /((iP([oa]+d|(hone)))|Android|WebOS|BlackBerry|windows (ce|phone))/i.test(e)
        }(navigator.userAgent || navigator.vendor || window.opera), angular.isOnline = function() {
            return window.navigator && window.navigator.onLine
        }, angular.findScopeWithProperty = function(e, t) {
            for (var n = e.$parent;;) {
                if (n && n.hasOwnProperty(t)) break;
                if (!n) return null;
                n = n.$parent
            }
            return n
        }, angular.trackPage = function(e, t) {
            return "undefined" == typeof ga ? !1 : (ga("set", {
                page: e,
                title: t || document.title
            }), void ga("send", "pageview"))
        }
    }(angular), String.prototype.ucfirst = function() {
        var e = this || "",
            t = e.charAt(0).toUpperCase();
        return t + e.substr(1, e.length - 1)
    }, String.prototype.ucwords = function() {
        var e = this || "",
            t = (e || "").split(" ").map(function(e) {
                return e.ucfirst()
            });
        return t.join(" ")
    };
var templates = angular.module("templates", []);
templates.run(["$templateCache", function(e) {
    e.put("cancel-order.html", '<md-bottom-sheet class="md-list md-has-header" ng-cloak>   <md-subheader>Anulare comandă</md-subheader>   <md-list>       <md-list-item>           <md-button flex ng-click="closeSheet()" class="md-list-item-content md-raised md-default">               <md-icon>check</md-icon>               Vreau să continui           </md-button>       </md-list-item>       <md-list-item>           <md-button flex ng-click="confirm()" class="md-list-item-content md-raised md-warn">               <md-icon>close</md-icon>               Vreau să anulez           </md-button>       </md-list-item>       <md-list-item>&nbsp;</md-list-item>   </md-list></md-bottom-sheet>'), e.put("schedule-day.html", '<div layout-padding>   <div layout="column">       <div layout="row">           <span class="md-display-2" ng-class="{\'required\': ! isValid()}">{{ weekday }}</span>           <md-select flex="10" placeholder="{{ hour }}" style="margin: 0 10px;" ng-required="isActivityDay()" class="md-mini" ng-show="isActivityDay()" ng-model="time" aria-label="Workout time">               <md-option ng-value="ts" ng-repeat="ts in workouts">{{ ts }}</md-option>           </md-select>           <span flex></span>       </div>       <div layout="row">           <md-button aria-label="Zi de antrenament" ng-click="setType(\'activity\')" class="md-raised" ng-class="{\' md-primary\': isActivityDay(), \'btn-left\': largeDevice}">               <md-icon>directions_run</md-icon> Zi de antrenament           </md-button>           <md-button aria-label="Zi de odihna" ng-click="setType(\'rest\')" class="md-raised" ng-class="{\'md-primary\': isRestDay(), \'btn-middle\': largeDevice}">               <md-icon>restore</md-icon> Zi fără antrenament           </md-button>           <md-button aria-label="Zi de detoxifiere" ng-click="setType(\'discharging\')" class="md-raised" ng-class="{\'md-primary\': isDetoxDay(), \'btn-right\': largeDevice}">               <md-icon>radio_button_unchecked</md-icon> Zi de detoxifiere           </md-button>       </div>   </div>   <md-divider></md-divider></div>')
}]), Unica.factory("FigureType", [function() {
    var e = {};
    return e.detect = function(e, t) {
        return e - t >= 6 ? 2 : t - e >= 6 ? 1 : 3
    }, e
}]), Unica.factory("PressureType", [function() {
    var e = "normotonie",
        t = "hipotonie",
        n = "hipertonie",
        r = "attention",
        a = {};
    return a.detect = function(e, t) {
        return e >= 140 ? this.id(n + "-" + r) : (e = this.detectBeforeValue(e), t = this.detectAfterValue(t), this.id(e + "-" + t))
    }, a.detectBeforeValue = function(n) {
        return 110 > n ? t : e
    }, a.detectAfterValue = function(t) {
        return 130 >= t ? e : n
    }, a.id = function(a) {
        var i = {
            1: e + "-" + e,
            2: t + "-" + e,
            3: t + "-" + n,
            4: n + "-" + r,
            5: e + "-" + n
        };
        for (var o in i)
            if (i[o] == a) return o;
        return console.log("Can not resolve: " + a), null
    }, a
}]), Unica.factory("System", ["$timeout", "$http", "aiStorage", function(e, t, n) {
    function r(e) {
        return e.data.data
    }

    function a(e) {
        return e.data.message
    }

    function i() {
        return {
            headers: {
                "X-TOKEN-ID": n.get("unica_token", Unica.STORAGE)
            }
        }
    }
    var o = {};
    return o.submitQuiz = function(e) {
        return t.post(location.href, e, i()).then(r)
    }, o.placeOrder = function(e) {
        return t.post("/customer/checkout", e, i()).success(function (response) {
            window.onbeforeunload = null;
            window.location.href = '/getPdf/' + response.history;
        })

    }, o.cancelOrder = function(e) {
        return t.get("/customer/order/" + e + "/cancel", i()).then(r)
    }, o.requestToken = function(e) {
        return t.post("/auth/token", {
            email: e
        }).then(a)
    }, o.confirmToken = function(e, n) {
        return t.post("/auth/confirm", {
            email: e,
            token: n
        }).then(a)
    }, o.register = function(e) {
        return t.post("/auth/register", e).then(a)
    }, o
}]), Unica.controller("FormularController", ["$scope", "System", "aiStorage", "FigureType", "PressureType", function(e, t, n, r, a) {
    function i() {
        n.set("unica_value", e.data, Unica.STORAGE)
    }

    function o() {
        return Object.keys(e.forms)
    }

    function s(t) {
        t ? n.set("unica_form", t, Unica.STORAGE) : n.get("unica_form", Unica.STORAGE) || n.set("unica_form", o()[0], Unica.STORAGE), e.currentSlide = o().indexOf(n.get("unica_form", Unica.STORAGE)), e.currentForm = o()[e.currentSlide]
    }

    function u(t) {
        return e.data.hasOwnProperty(t) || (e.data[t] = []), e.data[t]
    }

    function c(t) {
        return t ? e.forms[t].$valid : e.forms[e.currentForm].$valid
    }

    function d(t) {
        angular.extend(e.data, {
            office_id: parseInt(t.id)
        })
    }

    function l() {
        var t = parseInt(e.data.figure_type_id),
            n = e.lists.figureTypes;
        if (!t || !n.length) return "";
        for (var r in n)
            if (parseInt(n[r].id) == t) return n[r].image;
        return ""
    }

    function m() {
        return e.submitting = !0, t.submitQuiz(e.data).then(function(t) {
            e.submitting = !1, n.set("unica_value", {}, Unica.STORAGE), n.set("unica_form", "department", Unica.STORAGE), t.hasOwnProperty("user_id") && (window.onbeforeunload = null, location.href = "/customer/" + t.user_id)
        })["catch"](function(t) {
            if (e.submitting = !1, 422 == t.status) {
                var n = "";
                for (var r in t.data) n += r.toUpperCase() + ": " + t.data[r].join("\n");
                alert(n)
            }
        })
    }

    function f() {
        var t = e.data.hasOwnProperty("pressure_rest");
        return !t || t && parseInt(e.data.pressure_rest.max) < 140
    }
    e.isStepValid = c, e.setForm = s, e.finish = m, e.setDepartment = d, e.constitutionImage = l, e.requireLoadPressure = f, e.lists = {}, e.currentSlide = 0, e.forms = {
            department: {},
            setup: {},
            record: {},
            cardio: {},
            schedule: {},
            diseases: {},
            nutrition: {}
        }, e.data = {}, e.workoutDays = 0, e.restDays = 0, e.dischargingDays = 0, e.selectedDays = 0, e.$watch("data", function(t, n) {
            if (i(), t.hasOwnProperty("shoulders") && t.hasOwnProperty("buttocks") && (t.shoulders != n.shoulders || t.buttocks != n.buttocks) && (e.data.figure_type_id = r.detect(t.buttocks, t.shoulders)), t.hasOwnProperty("pressure_rest")) {
                var o = t.pressure_rest.max,
                    s = n.pressure_rest ? n.pressure_rest.max : null,
                    u = null,
                    c = n.pressure_load ? n.pressure_load.max : null;
                t.hasOwnProperty("pressure_load") && (u = t.pressure_load.max);
                var d = o && o != s && o >= 140,
                    l = o && u && (u != c || o != s);
                (d || l) && (e.data.pressure_type_id = a.detect(o, u))
            }
            if (t.hasOwnProperty("schedule")) {
                var m = 0,
                    f = 0,
                    g = 0;
                for (var p in t.schedule) {
                    var h = t.schedule[p];
                    switch (h.type) {
                        case "activity":
                            m++;
                            break;
                        case "rest":
                            f++;
                            break;
                        case "discharging":
                            g++
                    }
                }
                e.workoutDays = m, e.restDays = f, e.dischargingDays = g, e.selectedDays = m + f + g
            }
        }, !0), e.$on("Schedule::updatedDay", function(t, n) {
            e.data.hasOwnProperty("schedule") || (e.data.schedule = {});
            var r = n[0];
            if (n = n[1], "discharging" == n[r].type)
                for (var a in e.data.schedule) a != r && e.data.schedule.hasOwnProperty(a) && "discharging" == e.data.schedule[a].type && (e.data.schedule[a].type = "rest", e.$broadcast("Schedule::resetDay", a));
            angular.extend(e.data.schedule, n || {})
        }),
        function() {
            e.data = n.get("unica_value", Unica.STORAGE) || {}
        }(), s(), e.toggle = function(e, t) {
            var n = u(t),
                r = n.indexOf(e);
            r > -1 ? n.splice(r, 1) : n.push(e)
        }, e.exists = function(e, t) {
            var n = u(t);
            return n.indexOf(e) > -1
        }, e.submitting = !1, e.slideNext = function() {
            e.currentSlide += 1, s(forms()[e.currentSlide])
        }, e.slidePrev = function() {
            e.currentSlide >= 1 && (e.currentSlide -= 1, s(forms()[e.currentSlide]))
        }
}]), Unica.controller("HistoryController", ["$scope", "$timeout", "$mdDialog", function(e, t, n) {
    function r(e) {
        return "Document for " + e.user + " has been confirmed"
    }

    function a(e) {
        return "Document for " + e.user + " has been declined" + (e.hasOwnProperty("reason") ? ": \n" + e.reason : "")
    }

    function i(e) {
        return {
            mon: "Luni",
            tue: "Marti",
            wen: "Miercuri",
            thu: "Joi",
            fri: "Vineri",
            sat: "Simbata",
            sun: "Duminica"
        }[e]
    }

    function o() {
        return ["mon", "tue", "wen", "thu", "fri", "sat", "sun"]
    }

    function s(t) {
        return "pending" == e.records[t].status
    }

    function u(t) {
        return "declined" == e.records[t].status
    }

    function c(t) {
        return "confirmed" == e.records[t].status
    }
    e.records = {}, e.pending = s, e.confirmed = c, e.declined = u, e.key = "", e.channel = "", e.showRecordSchedule = function(e, t) {
        var r = angular.element(document.body);
        n.show({
            parent: r,
            targetEvent: e,
            template: '<md-dialog aria-label="List dialog">  <md-dialog-content>      <table class="table">       <tr ng-repeat="day in days">           <td><strong>{{ translateDay(day) }}:</strong></td>           <td>               <div ng-if="schedule[day].type == \'activity\'">Ze de antrenament (<strong>{{ schedule[day].time }}</strong>)</div>               <div ng-if="schedule[day].type == \'rest\'">Ze fara antrenament</div>               <div ng-if="schedule[day].type == \'discharging\'">Ze de detox</div>           </td>       </tr>      </table>  </md-dialog-content>  <md-dialog-actions>    <md-button ng-click="closeDialog()" class="md-primary">      Inchide    </md-button>  </md-dialog-actions></md-dialog>',
            locals: {
                schedule: t,
                days: o()
            },
            controller: function(e, t, n, r) {
                e.schedule = n, e.days = r, e.closeDialog = function() {
                    t.hide()
                }, e.translateDay = i
            }
        })
    }, e.showRecordAnswers = function(e, t) {
        var r = angular.element(document.body);
        n.show({
            parent: r,
            targetEvent: e,
            template: '<md-dialog aria-label="List dialog">  <md-dialog-content>    <md-list>      <ul class="list-unstyled">       <li ng-repeat="question in answers">           <strong>{{ question.question.question }}:</strong><br />           <em>&raquo;&nbsp;{{ question.answer.answer }}</em>       </li>       </ul>      </table>    </md-list>  </md-dialog-content>  <md-dialog-actions>    <md-button ng-click="closeDialog()" class="md-primary">      Inchide    </md-button>  </md-dialog-actions></md-dialog>',
            locals: {
                answers: t
            },
            controller: function(e, t, n) {
                e.answers = n, e.closeDialog = function() {
                    t.hide()
                }
            }
        })
    }, e.openDialog = function(e) {
        var t = n.alert({
            title: "confirmed" == e.status ? "Confirmed" : "Declined",
            content: "confirmed" == e.status ? r(e) : a(e),
            ok: "Close"
        });
        n.show(t)["finally"](function() {
            t = void 0
        })
    }, t(function() {
        var t = new Pusher(e.key, {
                encrypted: !0
            }),
            n = t.subscribe(e.channel);
        n.bind("DocumentProcessed", function(t) {
            if (t && t.record) {
                var n = t.record;
                angular.safeApply(e, function(e) {
                    e.records[n].status = t.status
                }), e.openDialog(t)
            }
        })
    })
}]), Unica.controller("NavigationController", ["$scope", "$mdSidenav", "$mdUtil", "$mdMedia", function(e, t, n, r) {
    function a(e) {
        var r = n.debounce(function() {
            t(e).toggle()
        }, 300);
        return r
    }
    e.toggleLeft = a("left"), e.$watch(function() {
        return [r("sm"), r("md"), r("lg")]
    }, function(t) {
        e.isSmall = r("sm"), e.isMedium = r("md"), e.isLarge = r("lg") || r("gt-lg")
    }, !0)
}]), Unica.controller("SearchController", ["$scope", "$http", function(e, t) {
    function n(n) {
        return t.post("/customer/search?include=images", {
            query: e.searchText
        }).then(function(e) {
            return e.data.data
        })
    }

    function r(e) {
        location.href = "/customer/" + e.id
    }
    e.searchText = "", e.simulateQuery = !1, e.isDisabled = !1, e.querySearch = n, e.selectedItemChange = r
}]), Unica.controller("SignupController", ["$scope", function(e) {
    e.customer = {}
}]), Unica.controller("UserFormularController", ["$scope", "System", "aiStorage", "FigureType", "PressureType", "$mdDialog", "$mdBottomSheet", function(e, t, n, r, a, i, o) {
    function s() {
        // return n.get("unica_token", Unica.STORAGE) ? void 0 : (u(), location.href = "/customer/signup", !1)
        return n.get("unica_token", Unica.STORAGE) ? void 0 : void 1
    }

    function u() {
        window.onbeforeunload = null
    }

    function c() {
        var e = $.get();
        if (e.pressure_rest && e.pressure_rest.max) {
            var t = parseInt(e.pressure_rest.max);
            if (t >= 140) $.merge({
                pressure_type_id: a.detect(t, null)
            });
            else if (t && e.hasOwnProperty("pressure_load") && e.pressure_load.max) {
                var n = e.pressure_load.max;
                $.merge({
                    pressure_type_id: a.detect(t, n)
                })
            } else $.merge({
                pressure_type_id: null
            })
        } else $.merge({
            pressure_type_id: null
        })
    }

    function d(e, t) {
        $.merge({
            figure_type_id: r.detect(t, e)
        })
    }

    function l() {
        n.set("unica_value", e.data, Unica.STORAGE)
    }

    function m() {
        n.set("unica_payment", e.payment, Unica.STORAGE)
    }

    function f() {
        return Object.keys(e.forms)
    }

    function g(t) {
        t ? n.set("unica_form", t, Unica.STORAGE) : n.get("unica_form", Unica.STORAGE) || n.set("unica_form", f()[0], Unica.STORAGE), e.currentSlide = f().indexOf(n.get("unica_form", Unica.STORAGE)), e.currentForm = f()[e.currentSlide], angular.trackPage("/customer/health-testing/" + e.currentForm, "Regim Alimentar - " + e.currentForm)
    }

    function p(t) {
        return e.data.hasOwnProperty(t) || (e.data[t] = []), e.data[t]
    }

    function h(t) {
        return t ? e.forms[t].$valid : e.forms[e.currentForm].$valid
    }

    function y() {
        var t = parseInt(e.data.figure_type_id),
            n = e.lists.figureTypes;
        if (!t || !n.length) return "";
        for (var r in n)
            if (parseInt(n[r].id) == t) return n[r].image;
        return ""
    }

    function v(t) {
        if (e.submitting = !1, 422 == t.status) {
            var n, r = "";
            for (n in t.data) t.data.hasOwnProperty(n) && (r += n.toUpperCase() + ": " + t.data[n].join("\n"));
            alert(r)
        }
    }

    function b() {
        return e.submitting = !0, t.submitQuiz(e.data).then(function(t) {
            e.submitting = !1, t && t.id && ($.merge(t), e.slideNext())
        })["catch"](v)
    }

    function w() {
        e.submitting = !0;
        var r = {
            history: $.get().id,
            offer: $.checkout.offer(),
            gateway: $.checkout.gateway()
        };
        t.placeOrder(r).then(function(t) {
            e.submitting = !1, t && t.id && (e.payment.order = t, e.slideNext(), n.set("unica_form", "setup", Unica.STORAGE), n.remove("unica_value", Unica.STORAGE), n.remove("unica_token", Unica.STORAGE), n.remove("unica_payment", Unica.STORAGE), clearInterval(O), u())
        })["catch"](v)
    }

    function S(n) {
        function r(e, t) {
            o.show({
                templateUrl: "cancel-order.html",
                controller: ["$scope", "$mdBottomSheet", function(e, n) {
                    e.closeSheet = function() {
                        n.hide()
                    }, e.confirm = t
                }],
                targetEvent: e
            })
        }

        function a() {
            return t.cancelOrder(e.payment.order.id).then(function() {
                delete e.payment.order, o.hide(), e.slidePrev()
            })["catch"](v)
        }
        r(n, a)
    }

    function _() {
        if (e.highRestPressure()) return !1;
        var t = $.get().hasOwnProperty("pressure_load");
        if (t && parseInt($.get().pressure_load.max) && parseInt($.get().pressure_load.min)) return !1;
        var n = $.get().hasOwnProperty("pressure_rest");
        return n && parseInt($.get().pressure_rest.max) < 140
    }

    function k(e) {
        return "/images/measurements/" + e + ".jpg"
    }
    s();
    var O = setInterval(s, 6e4);
    e.isStepValid = h, e.setForm = g, e.finish = b, e.placeOrder = w, e.cancelOrder = S, e.constitutionImage = y, e.requireLoadPressure = _, e.currentSlide = 0;
    var $ = {
        get: function() {
            return e.data
        },
        merge: function(t) {
            e.data = angular.extend(e.data, t || {})
        },
        checkout: {
            offer: function() {
                return e.payment.offer
            },
            gateway: function() {
                return e.payment.gateway
            }
        }
    };
    e.lists = {}, e.forms = {
            setup: {},
            record: {},
            cardio: {},
            schedule: {},
            diseases: {},
            nutrition: {},
            checkout: {},
            order: {}
        }, e.payment = {
            gateway: "qiwi"
        }, e.data = {
            schedule: {
                mon: {
                    type: "rest"
                },
                tue: {
                    type: "rest"
                },
                fri: {
                    type: "rest"
                },
                thu: {
                    type: "rest"
                },
                wen: {
                    type: "rest"
                },
                sat: {
                    type: "rest"
                },
                sun: {
                    type: "discharging"
                }
            }
        }, e.workoutDays = 0, e.restDays = 0, e.dischargingDays = 0, e.selectedDays = 0, e.$watch("data.pressure_rest.max", c), e.$watch("data.pressure_load.max", c), e.$watch("data", l, !0), e.$watch("payment", m, !0), e.$watch("data.shoulders", function() {
            d($.get().shoulders, $.get().buttocks)
        }), e.$watch("data.buttocks", function() {
            d($.get().shoulders, $.get().buttocks)
        }), e.$watch("data.schedule", function() {
            var t = $.get(),
                n = 0,
                r = 0,
                a = 0;
            for (var i in t.schedule) {
                var o = t.schedule[i];
                switch (o.type) {
                    case "activity":
                        n++;
                        break;
                    case "rest":
                        r++;
                        break;
                    case "discharging":
                        a++
                }
            }
            e.workoutDays = n, e.restDays = r, e.dischargingDays = a, e.selectedDays = n + r + a
        }, !0), e.$on("Schedule::updatedDay", function(t, n) {
            e.data.hasOwnProperty("schedule") || (e.data.schedule = {});
            var r = n[0];
            if (n = n[1], "discharging" == n[r].type)
                for (var a in e.data.schedule) a != r && e.data.schedule.hasOwnProperty(a) && "discharging" == e.data.schedule[a].type && (e.data.schedule[a].type = "rest", e.$broadcast("Schedule::resetDay", a));
            angular.extend(e.data.schedule, n || {})
        }),
        function() {
            $.merge(n.get("unica_value", Unica.STORAGE) || {})
        }(),
        function() {
            e.payment = angular.extend(e.payment, n.get("unica_payment", Unica.STORAGE) || {})
        }(), g(), e.highRestPressure = function() {
            return e.data.hasOwnProperty("pressure_rest") && e.data.pressure_rest.max > 130
        }, e.highLoadPressure = function() {
            return e.data.hasOwnProperty("pressure_load") && e.data.pressure_load.max > 130
        }, e.toggle = function(e, t) {
            var n = p(t),
                r = n.indexOf(e);
            r > -1 ? n.splice(r, 1) : n.push(e)
        }, e.exists = function(e, t) {
            var n = p(t);
            return n.indexOf(e) > -1
        }, e.submitting = !1, e.setMeasurementImage = function(t) {
            e.measurementImage = k(t)
        }, e.showMeasurementImagePopup = function(t, n) {
            var r = k(n);
            i.show({
                clickOutsideToClose: !0,
                scope: e,
                preserveScope: !0,
                template: '<md-dialog>  <md-dialog-content layout="column">     <img src="' + r + "?" + (new Date).getTime() + '" />     <md-button class="md-raised" ng-click="closeDialog()">Ok</md-button>  </md-dialog-content></md-dialog>',
                controller: function(e, t) {
                    e.closeDialog = function() {
                        t.hide()
                    }
                }
            })
        }, e.offerPrice = function() {
            return e.payment.offer ? e.lists.offers.filter(function(t) {
                return parseInt(t.id) == parseInt(e.payment.offer)
            })[0].price : "-"
        }, e.slideNext = function() {
            e.currentSlide += 1, g(f()[e.currentSlide])
        }, e.slidePrev = function() {
            e.currentSlide >= 1 && (e.currentSlide -= 1, g(f()[e.currentSlide]))
        }
}]), Unica.controller("UserRegisterController", ["$scope", "$mdDialog", "System", "aiStorage", "$timeout", function(e, t, n, r, a) {
    function i(t) {
        t.user && (e.email.user = t.user), t.token && r.set("unica_token", t.token, Unica.STORAGE)
    }
    r.set("unica_form", "setup", Unica.STORAGE), r.remove("unica_token", Unica.STORAGE), r.remove("unica_payment", Unica.STORAGE), r.remove("unica_value", Unica.STORAGE), e.data = {
        genders: []
    }, e.user = {
        gender: "female"
    }, e.errors = {}, e.submitting = !1, e.email = {
        user: null,
        token: null,
        requested: !1,
        confirmed: !1
    }, e.setGender = function(t) {
        t.disabled ? o("Atenție", t.message, "Am înțeles!") : e.user.gender = t.value
    }, e.requestToken = function() {
        angular.trackPage("/customer/signup/token-request", "Regim Alimentar - Send validation code"), e.submitting = !0, n.requestToken(e.user.email).then(function(t) {
            "ok" == t && (e.email.requested = !0), e.submitting = !1
        })
    }, e.confirmToken = function() {
        e.submitting = !0, n.confirmToken(e.user.email, e.email.token).then(function(t) {
            t.confirmed && (angular.trackPage("/customer/signup/token-confirmed", "Regim Alimentar - Token confirmed"), e.email.confirmed = !0), i(t), e.submitting = !1
        })["catch"](function(t) {
            o("Atenție", t.data.description.message, "Închide"), e.submitting = !1
        })
        location.href = '/customer/health-testing'
    }, e.goToFormular = function() {
        location.href = e.email.user.form_url
    }, e.register = function() {
        angular.trackPage("/customer/signup/register", "Regim Alimentar - Inregistrare"), e.errors = {}, e.submitting = !0, n.register(e.user).then(function(t) {
            i(t), e.submitting = !1, t.user && (location.href = t.user.form_url)
        })["catch"](function(t) {
            t.hasOwnProperty("data") && angular.isObject(t.data) && (e.errors = t.data), e.submitting = !1
        })
    };
    var o = function(e, n, r) {
        t.show(t.alert().clickOutsideToClose(!0).title(e).content(n).ariaLabel(e).ok(r))
    };
    e.currentSlide = 0, e.slideNext = function() {
        switch (e.currentSlide += 1, e.currentSlide) {
            case 1:
                return angular.trackPage("/customer/signup/email-request", "Regim Alimentar - Request email");
            case 2:
                return angular.trackPage("/customer/signup/registration", "Regim Alimentar - Registration info")
        }
    }, e.slidePrev = function() {
        e.currentSlide > 1 && (e.currentSlide -= 1)
    }
}]), Unica.directive("ngScheduleDay", ["$templateCache", "$mdMedia", function(e, t) {
    return {
        restrict: "E",
        replace: !0,
        scope: {
            day: "@",
            weekday: "@",
            num: "@",
            load: "@",
            rest: "@",
            discharging: "@",
            hour: "@"
        },
        link: function(e) {
            function n() {
                var t = {};
                return t[e.day] = {
                    type: e.type
                }, e.isActivityDay() && angular.extend(t[e.day], {
                    time: e.time
                }), t
            }
            e.media = t;
            var r = e.$parent.data.schedule;
            e.type = r && r[e.day] && r[e.day].type ? r[e.day].type : null, e.time = r && r[e.day] && r[e.day].time ? r[e.day].time : null, e.isValid = function() {
                return e.type ? e.isActivityDay() && !e.time ? !1 : !0 : !1
            }, e.workouts = ["07:00", "07:30", "08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00", "18:30", "19:00", "19:30", "20:00", "20:30"], e.setType = function(t) {
                e.type = t, e.$emit("Schedule::updatedDay", [e.day, n()])
            }, e.largeDevice = t("min-width: 600px"), e.isDetoxDay = function() {
                return "discharging" == e.type
            }, e.isActivityDay = function() {
                return "activity" == e.type
            }, e.isRestDay = function() {
                return "rest" == e.type
            }, e.$watch("time", function(t, r) {
                t !== r && e.$emit("Schedule::updatedDay", [e.day, n()])
            }), e.$on("Schedule::resetDay", function(t, n) {
                n == e.day && e.setType("rest")
            })
        },
        template: e.get("schedule-day.html")
    }
}]), Unica.directive("ngValidateCount", function() {
    return {
        restrict: "A",
        require: "ngModel",
        link: function(e, t, n, r) {
            function a(e, t) {
                return parseInt(e) === t
            }

            function i(e) {
                r.$setValidity("minCount", a(e, o))
            }
            var o = parseInt(n.ngValidateCount);
            r.$parsers.unshift(function(e) {
                return i(e), e ? e : void 0
            }), r.$formatters.unshift(function(e) {
                return i(e), e
            })
        }
    }
});
