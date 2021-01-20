import app from 'flarum/app';
import LogInModal from 'flarum/components/LogInModal';
import {extend} from 'flarum/extend';
import Page from "flarum/components/Page";

/* global m */

app.initializers.add('tiborsulyan/loginredirect', () => {

    extend(Page.prototype, 'oninit', function () {
        const urlParams = new URLSearchParams(window.location.search);
        const notfound = urlParams.get('notfound');
        const dest = urlParams.get('dest');

        if (!app.session.user && notfound && dest) {
            setTimeout(() => app.modal.show(LogInModal));
        } else if (app.session.user && notfound && dest) {
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
