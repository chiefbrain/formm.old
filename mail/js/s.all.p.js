var formm = {
    c: 0,
    srcCap: "https://formm.ru/captcha/?",
    srcSpin: "https://formm.ru/refresh/loader001.gif",
    srcRef1: "https://formm.ru/refresh/refresh.png",
    srcRef2: "https://formm.ru/refresh/refresh2.png",
    fCaptcha: [],
    fRefresh: [],
    refreshOn: true,
    toId: "",
    sub: function (e) {
        if (e.check !== undefined) {
            var t = e.check.value,
                n = t.split("."),
                r = {},
                i = {},
                s, o, u, a;
            for (s = 0; s < n.length; s++) {
                o = n[s].split(":");
                u = o[0];
                if (e[o[0]] !== undefined)
                    a = e[o[0]].value;
                r[u] = a;
                i[u] = o[1];
                if (u !== "email" && u !== "captcha" && a === "") {
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
                return false;
            } else
                return true;
        } else
            return true;
    }, cap: function () {
        if (this.refreshOn) {
            this.cRand();
            this.refreshOn = false;
            var e = document.getElementsByTagName("img"),
                r, s, o;
            for (o = 0; o < e.length; o++) {
                s = e[o];
                r = s.getAttribute("alt");
                // i = s.getAttribute("src");
                if (r !== null && r === "formm.captcha") { // || i !== null && i.match(/formm.ru\/captcha/i)) {
                    s.style.display = 'none';
                    s.src = this.srcCap + this.c;
                    this.fCaptcha.push(s);
                } else if (r !== null && r === "formm.refresh") {
                    s.src = this.srcRef2;
                    this.fRefresh.push(s);
                }
            }
            this.toId = setTimeout(function () {
                formm.lcend()
            }, 150);
        }
    }, lcend: function () {
        clearTimeout(this.toId);
        for (var e = 0; e < this.fCaptcha.length; e++) {
            this.fCaptcha[e].style.display = '';
        }
        for (var e = 0; e < this.fRefresh.length; e++) {
            this.fRefresh[e].src = this.srcRef1
        }
        this.refreshOn = true
    }, cRand: function () {
        this.c = Math.floor(Math.random() * 1e9) + 100
    }, ln: function () {
        this.cRand();
        var d = document;
        var i = d.getElementsByTagName("img"),
            e = d.getElementsByTagName("a"),
            link = this.srcCap + this.c,
            r, s, o;
        for (o = 0; o < i.length; o++) {
            s = i[o];
            r = s.getAttribute("alt");
            if (r !== null && r === "formm.captcha") {
                link = s.src;
                break;
            }
        }

        for (var t = 0; t < e.length; t++) {
            var i = e[t].getAttribute("href");
            if (i !== null && /:\/\/formm\.ru/i.test(i)) {
                var s = e[t].getAttribute("style");
                var o = "left";
                if (s !== null && /float:right/i.test(s)) {
                    o = "right";
                }

                var w = d.createElement('div');
                w.style.position = 'relative';
                w.style.width = '100px';
                w.style.height = '50px';
                w.style.cssFloat = o;
                w.style.styleFloat = o;

                var l = d.createElement('img');
                l.style.position = 'absolute';
                l.style.border = "none";
                l.src = this.srcSpin;
                w.appendChild(l);

                var u = d.createElement('img');
                u.style.position = 'absolute';
                u.style.border = "none";
                u.alt = "formm.captcha";
                u.title = "captcha";
                u.src = link;
                w.appendChild(u);

                e[t].parentNode.replaceChild(w, e[t])
            }
        }
    }
};

formm.ln();
