var formm = {
    c: 0,
    srccap: "https://formm.ru/captcha/?",
    srcspin: "https://formm.ru/refresh/loader001.gif",
    srcref1: "https://formm.ru/refresh/refresh.png",
    srcref2: "https://formm.ru/refresh/refresh2.png",
    fcaptcha: [],
    frefresh: [],
    refreshon: true,
    tmpimg: "",
    toid: "",
    sub: function (e) {
        if (e.check !== undefined) {
            var t = e.check.value;
            var n = t.split(".");
            var r = {},
                i = {},
                s, o, u, a;
            for (s = 0; s < n.length; s++) {
                o = n[s].split(":");
                u = o[0];
                if (e[o[0]] !== undefined)
                    a = e[o[0]].value;
                r[u] = a;
                i[u] = o[1];
                if (u != "email" && u != "captcha" && a == "") {
                    alert(o[1]);
                    return false
                } else
                    r[u] = a
            }
            if (!r.email.match(/^[a-z\d]+((\.|\-|\_)?[a-z\d]+)*@[a-z\d]+((\.|\-)?[a-z\d]+)*\.[a-z]{2,4}$/i)) {
                alert(i.email);
                return false
            } else if (!r.captcha.match(/^[a-z0-9]{5,6}$/i)) {
                alert(i.captcha);
                return false
            } else
                true
        } else
            true
    }, cap: function () {
        if (this.refreshon) {
            this.refreshon = false;
            var e = document.getElementsByTagName("img");
            var t = 0,
                n = 0,
                r, i, s, o;
            for (o = 0; o < e.length; o++) {
                s = e[o];
                r = s.getAttribute("alt");
                i = s.getAttribute("src");
                if (r !== null && r == "formm.captcha" || i !== null && i.match(/formm.ru\/captcha/i)) {
                    s.src = this.srcspin;
                    this.fcaptcha[t++] = s
                } else if (r !== null && r == "formm.refresh") {
                    s.src = this.srcref2;
                    this.frefresh[n++] = s
                }
            }
            // this.toid = setTimeout(function () {
            //     formm.lcstart()
            // }, 1500);
            this.lcstart()
        }
    }, lcstart: function () {
        this.cRand();
        this.tmpimg = document.createElement("img");
        this.tmpimg.onload = function () {
            setTimeout(function () {
                formm.lcend()
            }, 200)
        };
        this.tmpimg.onerror = function () {
            setTimeout(function () {
                formm.lcstart()
            }, 100)
        };
        this.tmpimg.src = this.srccap + this.c
    }, lcend: function () {
        clearTimeout(this.toid);
        for (var e = 0; e < this.fcaptcha.length; e++) {
            this.fcaptcha[e].src = this.srccap + this.c
        }
        for (var e = 0; e < this.frefresh.length; e++) {
            this.frefresh[e].src = this.srcref1
        }
        this.refreshon = true
    }, crand: function () {
        this.c = Math.floor(Math.random() * 1e9) + 100
    }, ln: function () {
        this.cRand();
        var e = document.getElementsByTagName("a");
        var t, n = [],
            r = 0;
        for (t = 0; t < e.length; t++) {
            var i = e[t].getAttribute("href");
            if (i !== null && i.match(/formm\.ru/i)) {
                n[r++] = e[t]
            }
        }
        for (t = 0; t < r; t++) {
            var s = n[t].getAttribute("style");
            var o = "left";
            if (s !== null && s.match(/float:right/i))
                o = "right";
            var u = document.createElement("img");
            u.style.border = "none";
            u.alt = "formm.captcha";
            u.title = "captcha";
            u.align = o;
            u.style.cssFloat = o;
            u.style.styleFloat = o;
            u.src = this.srccap + this.c;
            n[t].parentNode.replaceChild(u, n[t])
        }
    }
};
formm.ln();
