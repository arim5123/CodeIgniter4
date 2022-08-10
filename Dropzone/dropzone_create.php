<!DOCTYPE>
<html>
<head>
    <link href="/bootstrap/css/styles.css" rel="stylesheet" />
    <script src="/bootstrap/js/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/js/common.js"></script>
    <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css" />
    <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
</head>
<body>
<div class="d-flex" id="wrapper">
    <form id="board_notice" class="form-inline" name="fname" method="POST">
        <h3>특색교육 등록</h3>
        <table class="intro">
            <thead>
            <tr>
                <th width="10%"></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>제목</td>
                <td><input type="text" id="title" name="title" class="form-control-file border" style="width: 60%;"/></td>
            </tr>
            <tr>
                <td>첨부파일<br>(다중이미지)</td>
                <td>
                    <div id="dropzone" class="dropzone"></div>
                    최적합 사이즈(가로*세로) : px * px
                </td>
            </tr>
        </table>
        <p style="text-align:center">
            <button id="btn-upload-file" class="btn btn-primary" type="button">등록</button>
        </p>
    </form>
    <script>
        Dropzone.options.dropzone = {
            url: '/admin/promotion/education_upload',
            autoProcessQueue: false,   // 자동업로드 여부 (true일 경우, 바로 업로드 되어지며, false일 경우, 서버에는 올라가지 않은 상태임 processQueue() 호출시 올라간다.)
            maxFiles: 50,              // 업로드 파일수
            maxFilesize: 50,           // 최대업로드용량 : 50MB
            parallelUploads: 50,       // 동시파일업로드 수(이걸 지정한 수 만큼 여러파일을 한번에 컨트롤러에 넘긴다.)
            addRemoveLinks: true,      // 삭제버튼 표시 여부
            dictRemoveFile: '삭제',    // 삭제버튼 표시 텍스트
            uploadMultiple: true,      // 다중업로드 기능
            init: function () {
                var submitButton = document.querySelector("#btn-upload-file");
                var myDropzone = this; //closure
                submitButton.addEventListener("click", function () {
                    let title = $('#title').val();
                    myDropzone.processQueue();
                });
                myDropzone.on('success', function () {
                    myDropzone.removeAllFiles();
                    $('#title').val("");
                });
            },
            sending: function (file, xhr, formData) {
                formData.append("title", $('#title').val());
            },
            complete:function(rs){
                console.log(rs);
                if(rs['status'] == "success"){
                    Swal.fire({title : '등록되었습니다.', icon: 'success'}).then((result) => { location.replace('/admin/'); });
                }else{
                    Swal.fire({title : '작업이 완료되지 않았습니다.', text:'다시 확인해주세요.', icon: 'error'}).then((result) => { location.replace('/admin/'); });
                }
            }
        };
    </script>
</div>
</body>
</html>
