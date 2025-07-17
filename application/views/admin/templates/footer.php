</div> 
</div> <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<link href="<?php echo base_url('assets/plugins/summernote/summernote-lite.min.css'); ?>" rel="stylesheet">

<script src="<?php echo base_url('assets/plugins/summernote/summernote-lite.min.js'); ?>"></script>

<script>
    // Inisialisasi Tooltip Bootstrap (jika digunakan)
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });

    // Inisialisasi Summernote setelah DOM sepenuhnya siap
    $(document).ready(function() {
       if ($('#isi').length) {
                $('#isi').summernote({
                    placeholder: 'Tulis isi artikel di sini...',
                    tabsize: 2,
                    height: 400, // Sesuaikan tinggi sesuai keinginan Anda
                    minHeight: null,
                    maxHeight: null,
                    focus: true,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph', 'blockquote', 'hr']],
                        ['height', ['height']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video', 'hr']],
                        ['view', ['fullscreen', 'codeview', 'help']],
                        ['misc', ['undo', 'redo', 'print', 'airmode']]
                    ],
                    popover: {
                        image: [
                            ['image', ['resizeM', 'resizeW', 'resizeAbs', 'floatL', 'floatR', 'floatNone', 'removeMedia']],
                            ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                        ],
                        link: [
                            ['link', ['linkDialogShow', 'unlink']]
                        ],
                        table: [
                            ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                            ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                        ],
                        air: [
                            ['color', ['color']],
                            ['font', ['bold', 'underline', 'clear']],
                            ['para', ['ul', 'paragraph']],
                            ['table', ['table']],
                            ['insert', ['link', 'picture']]
                        ]
                    },
                    callbacks: {
                        onChange: function(contents, $editable) {
                            $('#isi').val(contents);
                        },
                        // Callback untuk upload gambar dari editor (drag/drop/paste/browse)
                        onImageUpload: function(files) {
                            var editor = $(this);
                            var data = new FormData();
                            data.append('file', files[0]); // Ambil file pertama saja jika banyak

                            $.ajax({
                                url: '<?php echo site_url('admin/upload_gambar_editor'); ?>', // URL endpoint di controller
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: data,
                                type: "POST",
                                success: function(response) {
                                    if (response.status === 'success') {
                                        editor.summernote('insertImage', response.url); // Masukkan gambar ke editor
                                    } else {
                                        alert('Gagal mengunggah gambar: ' + response.message);
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.error("Upload failed:", textStatus, errorThrown, jqXHR.responseText);
                                    alert('Terjadi kesalahan saat mengunggah gambar.');
                                }
                            });
                        },
                        // Callback untuk menghapus gambar dari editor
                        onMediaDelete: function(target) {
                            var fileUrl = $(target).attr('src'); // Ambil URL gambar dari atribut src
                            // Pastikan ini adalah gambar yang diupload ke server Anda, bukan dari luar
                            if (fileUrl.includes('<?php echo base_url('uploads/'); ?>')) {
                                $.ajax({
                                    url: '<?php echo site_url('admin/delete_gambar_editor'); ?>', // URL endpoint untuk menghapus gambar
                                    data: {file_url: fileUrl},
                                    type: "POST",
                                    success: function(response) {
                                        if (response.status === 'success') {
                                            console.log('Gambar berhasil dihapus dari server: ' + fileUrl);
                                        } else {
                                            console.error('Gagal menghapus gambar dari server: ' + response.message);
                                        }
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        console.error("Delete failed:", textStatus, errorThrown, jqXHR.responseText);
                                    }
                                });
                            }
                            $(target).remove(); // Hapus elemen gambar dari editor
                        }
                    }
                });

                // Pastikan konten Summernote disinkronkan ke textarea saat form disubmit
                $('form').on('submit', function() {
                    $('#isi').summernote('save');
                });
            }
    });
</script>

</body>
</html>