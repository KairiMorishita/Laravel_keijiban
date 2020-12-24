// 編集モーダル
$('#edit_modal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget)
    let post_id = button.data('id')
    let text = button.data('text')
    $('#edit_form').attr('action', post_id)
    $('.modal-body .edit-text').text(text)
})

// 削除モーダル
$('#delete_modal').on('show.bs.modal', function (event) {
    let button = $(event.relatedTarget)
    let post_id = button.data('id')
    $('#delete_form').attr('action', post_id)
})

// 画像プレビュー
$('form').on('change', 'input[type="file"]', event => {
    const file = event.target.files[0],
          reader = new FileReader(),
          preview = $('.preview-cover'); // 表示する所
          textarea = $('.post-form textarea'); // 表示する所
    // 画像ファイル以外は処理停止
    if(file.type.indexOf("image") < 0){
      return false;
    }
    // ファイル読み込みが完了した際に発火するイベントを登録
    reader.onload = function(e) {
        // .prevewの領域の中にロードした画像を表示
        preview.attr('src', e.target.result);
        // フォーム領域を拡大
        textarea.attr('rows', 5);
	 
	document.getElementById("image").style.display = "inline";
    };
    reader.readAsDataURL(file);
});
