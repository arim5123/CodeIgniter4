//View
<div class="d-flex" id="wrapper">
    <?php echo view('\admin\include\nav_menu'); ?>
    <div id="page-content-wrapper">
        <?php echo view('\admin\include\top'); ?>
        <div class="container" style="margin-top: 50px">
            <form class="form-inline" method="POST" enctype="multipart/form-data">
                <h3>Title부분</h3>
                <table class="intro">
                    <tr>
                        <td>첨부파일(이미지)</td>
                        <td style="color: #888888">
                            <input type="file" name="files" class="form-control-file border"/>
                            &nbsp;&nbsp;최적합 사이즈(가로*세로) : px * px
                        </td>
                    </tr>
                </table>
                <p style="text-align:center">
                    <a href="/admin/intro"><button type="button" class="btn btn-danger">취소</button></a> &nbsp;
                    <button class="btn btn-primary" type="submit">추가</button>
                </p>
            </form>
        </div>
    </div>
</div>



//Controller
public function create()
    {
        if($this->request->getMethod() === "get") {
            $session = session();
            $my_id = $session->get('id');
            return view("/admin/students/create",[
                'my_id' => $my_id
            ]);
        }

        $model = new Students01FilesModel(); 

        $files = $this->request->getFileMultiple("files");

        foreach ($files as $file) {
            $fileInfo = [];
            if ($file != null) {
                if (!$file->isValid()) {
                    $errorString = $file->getErrorString();
                    $errorCode = $file->getError();
                } else {
                    $savedPath = $file->store('../../public/img/students/');
                    $fileInfo['file_name'] = $file->getName();
                    $fileInfo['real_name'] = $file->getClientName();
                }
            }
            $model->insert($fileInfo);
        }
    }
