    var Ziggy = {
        namedRoutes: {"home.index":{"uri":"\/","methods":["GET","HEAD"],"domain":null},"login":{"uri":"login","methods":["GET","HEAD"],"domain":null},"login.store":{"uri":"login","methods":["POST"],"domain":null},"sign-up.create":{"uri":"sign-up","methods":["GET","HEAD"],"domain":null},"sign-up.store":{"uri":"sign-up\/store","methods":["POST"],"domain":null},"sign-up.done":{"uri":"sign-up\/done","methods":["GET","HEAD"],"domain":null},"dashboard.apps.index":{"uri":"dashboard\/apps","methods":["GET","HEAD"],"domain":null},"dashboard.apps.show":{"uri":"dashboard\/apps\/{appId}","methods":["GET","HEAD"],"domain":null},"dashboard.apps.create":{"uri":"dashboard\/apps\/create","methods":["GET","HEAD"],"domain":null},"dashboard.apps.store":{"uri":"dashboard\/apps\/store","methods":["POST"],"domain":null},"dashboard.apps.state.update":{"uri":"dashboard\/apps\/{appId}\/state","methods":["PATCH"],"domain":null}},
        baseUrl: 'http://ryok.test/',
        baseProtocol: 'http',
        baseDomain: 'ryok.test',
        basePort: false,
        defaultParameters: []
    };

    if (typeof window.Ziggy !== 'undefined') {
        for (var name in window.Ziggy.namedRoutes) {
            Ziggy.namedRoutes[name] = window.Ziggy.namedRoutes[name];
        }
    }

    export {
        Ziggy
    }
