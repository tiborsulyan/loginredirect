import app from 'flarum/app';
import LogInModal from 'flarum/components/LogInModal';
import {extend} from 'flarum/extend';
import Page from "flarum/components/Page";

/* global m */

const isEmpty = function (o) {
    return Object.keys(o).length === 0 && o.constructor === Object;
};

app.initializers.add('tiborsulyan/loginredirect', () => {

    extend(Page.prototype, 'oninit', function () {
        const urlParams = new URLSearchParams(window.location.search);
        const notfound = urlParams.get('notfound');
        const dest = urlParams.get('dest');
        console.log("current.type", app.current.type);
        console.log("current.data", app.current.data);
        console.log("prev.type", app.previous.type);
        console.log("prev.data", app.previous.data);
        if (!app.session.user) {
            if (notfound && dest || isEmpty(app.previous.data) && location.path === "/") {
                setTimeout(() => app.modal.show(LogInModal));
            }
        } else if (notfound && dest) {
            m.route.set(dest);
        }
    });

    extend(LogInModal.prototype, 'oninit', function () {
        const urlParams = new URLSearchParams(window.location.search);
        const notfound = urlParams.get('notfound');
        const dest = urlParams.get('dest');
        if (!app.session.user && notfound && dest) {
            this.alertAttrs = {
                type: 'warning',
                content: app.translator.trans('tiborsulyan-loginredirect.forum.login-message')
            };
        }
    });

});
