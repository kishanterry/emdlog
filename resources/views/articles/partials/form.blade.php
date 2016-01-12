<div class="container-fluid" id="text-editor">
    <form action="{{ url('articles') }}" method="POST">
        <div class="text-editor">
            <div class="editor">
                <input type="hidden" v-model="article.id" value="{{ $article->id }}">
                <input v-model="article.title"
                       type="text"
                       name="title"
                       value="{{ $article->title }}"
                       class="editor-title"
                       debounce="300"
                       placeholder="Article Title">
                <textarea v-model="article.article"
                          name="article"
                          class="editor-article"
                          debounce="300"
                          placeholder="Article">{{ $article->article }}</textarea>

            </div>
            <div class="preview">
                <h1 v-html="article.title"></h1>
                <small>
                    <i class="fa fa-calendar"></i>
                    Publish Date
                </small>
                <hr>
                <div v-html="article.article | marked"></div>
            </div>
        </div>
    </form>
    <br>
    <div class="btn-group">
        <a href="#"
           @click.prevent="publish"
           class="btn btn-primary">
                    <span v-if="publishingArticle">
                        <i class="fa fa-spinner fa-spin"></i>
                        Publishing
                    </span>
                    <span v-else>
                        <i class="fa fa-send"></i>
                        Publish
                    </span>
        </a>
        <a href="#"
           @click.prevent="draft"
           class="btn btn-success">
                    <span v-if="savingDraft">
                        <i class="fa fa-spinner fa-spin"></i>
                        Saving Draft
                    </span>
                    <span v-else>
                        <i class="fa fa-save"></i>
                        Draft
                    </span>
        </a>
    </div>
</div>