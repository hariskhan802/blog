//Haider's Work
var base_url = $('#base_url').val();
function selector(val) {
    for (var i = 0; i < ShortCode.length; i++) {
        if (ShortCode[i].name == val) {
            return ShortCode[i].short_code;
        }
    }
    return;
}
function button(editor) {
    var menuItems = [];
    console.log(ShortCode);
    for (var i = 0; i < ShortCode.length; i++) {
        var keys = ShortCode[i].name,
                dataCode = {
                    text: keys,
                    shortcode: ShortCode[i].short_code,
                    onclick: function (e) {
                        console.log(selector(e.control.settings.text));
                        editor.insertContent(selector(e.control.settings.text));
                    }
                };
        menuItems.push(dataCode);
    }
    return menuItems;
}
tinymce.init({
    selector: '.tinymce',

    height: 500,
    toolbar1: "undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code | mybutton",
    toolbar2: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | visualchars visualblocks nonbreaking pagebreak restoredraft",
    menubar: false,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons paste textcolor filemanager code"
    ],
    content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css'],
 
    relative_urls: false,
    remove_script_host: false,
    convert_urls: true,
    filemanager_crossdomain: true,
    powerpaste_word_import: 'prompt',
    powerpaste_html_import: 'prompt'
});