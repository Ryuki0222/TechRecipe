$(document).ready(function(){

    // プログラミング作品カードをクリックしたとき詳細ページに遷移する
    $('.work').on('click',function () {
        window.location.href = $(this).find('a').attr('href');
    });

    // ログアウト処理（とりあえずいまはユーザアイコンクリックで発火）
    $('.user_icon').on('click',function () {
        window.location.href = '/logout';
    });

    // 投稿ページで画像をアップロードしたらプレビュー画像を表示する
    $('form').on('change', 'input[type="file"]', function(e) {
        console.log('hakka');
        var file = e.target.files[0],
            reader = new FileReader(),
            $preview = $(this).prev('div');
            t = this;
        // 画像ファイル以外の場合は何もしない
        if(file.type.indexOf('image') < 0){
          return false;
        }
        reader.onload = (function(file) {
          return function(e) {
            $preview.empty();
            $preview.append($('<img>').attr({
                      src: e.target.result,
                      class: "preview",
                      title: file.name
                  }));
          };
        })(file);

        reader.readAsDataURL(file);
    });

    // 制作手順フローの追加処理
    $('.plus').on('click',function () {
        // 前のflowが未入力だったら増やさない
        var img = $(this).prev('.flow').find('.flow_img img').attr('src');
        var description = $(this).prev('.flow').find('.flow_description').val();
        var references = $(this).prev('.flow').find('.flow_references').val();
        var last_no = parseInt($(this).prev('.flow').attr('data-no'));
        if (img != null && description !== '' && references !== '') {
            last_no++;
            var tags = '\
                <div class="flow" data-no="'+last_no+'">\
                    <h4>制作フロー '+last_no+'</h4>\
                    <div class="flow_img"><span>作品を表す画像をアップロード</span></div>\
                    <input class="flow_img_uploder" name="flow_img[]" type="file" />\
                    <textarea class="flow_description" name="flow_description[]" placeholder="作り方の説明"></textarea>\
                    <textarea class="flow_reference" name="flow_reference[]" placeholder="参考にしたURLリスト"></textarea>\
                </div>';
            $(this).before(tags);
        }
    });

});