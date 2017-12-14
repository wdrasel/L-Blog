@section('style')
    <link rel="stylesheet" href="/adminPanel/plugins/tag-editor/jquery.tag-editor.css">
@endsection

@section('script')
    <script src="/adminPanel/plugins/tag-editor/jquery.caret.min.js"></script>
    <script src="/adminPanel/plugins/tag-editor/jquery.tag-editor.min.js"></script>
    <script type="text/javascript">

        var options = {};

        @if($post->exists)
            options = {

            initialTags: {!! json_encode($post->tags->pluck('name')) !!}
        };


        @endif
        $('input[name=post_tags]').tagEditor(options);


        $('ul.pagination').addClass('no-margin pagination-sm');

        $('#title').on('blur',function () {
            var theTitle= this.value.toLowerCase().trim(),
                slugInput= $('#slug');

            theSlug= theTitle.replace(/&/g, '-and-')
                .replace(/[^a-z0-9-]+/g, '-')
                .replace(/\-\-+/g, '-')
                .replace(/^-+|-+$/g, '');


            slugInput.val(theSlug);
        });


       /*for tex editor script*/
         $(document).ready(function() {
            var htmlContent = $('#body').summernote('code');
            var plainText = $(htmlContent).text();
        });




        $('#published_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            showClear:true
        });

        $('#datetimepicker1').datetimepicker();

        $('#draft-btn').click(function(e) {
            e.preventDefault();
            $('#published_at').val("");
            $('#post-form').submit();
        });


        </script>

    @endsection
