<template>
    <div>
        <select class="js-example-placeholder-multiple js-data-example-ajax form-control" multiple="multiple" name="topics[]">
        </select>
    </div>
</template>

<script>
    import $ from 'jquery';
    export default {
        mounted() {
            $(document).ready(function () {
                $(".js-example-placeholder-multiple").select2({
                    tags: true,
                    placeholder: '选择相关话题',
                    minimumInputLength: 2,

                    ajax: {
                        url: '/api/topics',
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                q: params.term
                            };
                        },
                        processResults: function (data, params) {
                            return {
                                results: data
                            };
                        },
                        cache: true
                    },
                    templateResult: this.formatTopic,
                    templateSelection: this.formatTopicSelection,
                    escapeMarkup: function (markup) { return markup; }
                });
            })
        },
        methods: {
            formatTopic (topic) {
                return "<div class='select2-result-repository clearfix'>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'>" +
                    topic.name ? topic.name : "Laravel"   +
                    "</div></div></div>";
            },
            formatTopicSelection (topic) {
                return topic.name || topic.text;
            }
        }
    }
</script>
