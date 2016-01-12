// Register all the globals
window.$ = window.jQuery = require('jquery');
window.Vue = require('vue');

require('bootstrap-sass/assets/javascripts/bootstrap');

var marked = require('marked');
var VueResource = require('vue-resource');

Vue.use(VueResource);
Vue.http.headers.common['X-CSRF-TOKEN'] = Emdlog.csrfToken;

new Vue({
    el: '#text-editor',

    data: {
        article: {
            id: '',
            title: '',
            article: '',
            published: false
        },

        savingDraft: false,
        publishingArticle: false
    },

    filters: {
        marked: marked
    },

    methods: {
        draft: function () {
            if (this.article.title.length && this.article.article.length) {
                this.savingDraft = true;
                this.article.published = false;

                this.$http.post('/articles/draft', this.article)
                    .then(function (response) {
                        this.article.id = response.data.id;
                        this.savingDraft = false;
                    })
                    .catch(function () {
                        this.savingDraft = false;
                    });
            }
        },

        publish: function () {
            if (this.article.title.length && this.article.article.length) {
                this.publishingArticle = true;
                this.article.published = true;

                this.$http.post('/articles/publish', this.article)
                    .then(function (response) {
                        this.article.id = response.data.id;
                        this.publishingArticle = false;
                    })
                    .catch(function () {
                        this.publishingArticle = false;
                    });
            }
        }
    }
});