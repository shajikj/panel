<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>All Editors Example</title>

    <!-- Quill CSS -->
    <link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">

    <!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

</head>

<body>

    <!-- ===================== QUILL ====================== -->
    <h3>Quill Editor</h3>
    <form action="save_quill.php" method="post">
        <div id="quillEditor" style="height:200px;"></div>
        <input type="hidden" name="quillContent" id="quillContent">
        <button type="submit" onclick="submitQuill()">Save Quill</button>
    </form>
    <hr><br>


    <!-- ================== CKEDITOR 5 ===================== -->
    <h3>CKEditor</h3>
    <form action="save_ck.php" method="post">
        <textarea id="ckeditor" name="ckContent"></textarea>
        <button type="submit">Save CKEditor</button>
    </form>
    <hr><br>


    <!-- ================== TINYMCE ======================== -->
    <h3>TinyMCE</h3>
    <form action="save_tiny.php" method="post">
        <textarea id="tinyEditor" name="tinyContent"></textarea>
        <button type="submit">Save TinyMCE</button>
    </form>



    <!-- JS FILES -->
    <!-- CKEditor -->
    <script src="https://cdn.jsdelivr.net/npm/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>

    <!-- Quill -->
    <script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>

    <script>
        // Quill
        var quill = new Quill('#quillEditor', { theme: 'snow' });
        function submitQuill() {
            document.getElementById('quillContent').value = quill.root.innerHTML;
        }

        // CKEditor 5
        ClassicEditor
            .create(document.querySelector('#ckeditor'))
            .catch(error => { console.error(error); });

        // TinyMCE
        tinymce.init({
            selector: '#tinyEditor',
            height: 300
        });
    </script>

</body>

</html>
