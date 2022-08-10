public function education_upload(){

        $db = db_connect();
        $model = new PromotionEducationModel();
        $rs = "failed";

        $files = $this->request->getFileMultiple("file");
        $title = $this->request->getPost('title');

        $sql_max = 'SELECT max(post_id) as post_id, max(d_order) as d_order FROM promotion_education';
        $rst_max = $db->query($sql_max);
        $get_max = $rst_max->getResultArray();
        $post_id = (int)$get_max[0]['post_id'] + 1;
        $d_order = (int)$get_max[0]['d_order'] + 1;

        $data = ['post_id' => $post_id, 'title'   => $title, 'd_order' => $d_order ];

        $result_title = $model->insert($data);
        if ($result_title != null) {
            foreach ($files as $file) {
                $fileInfo = [];
                if ($file != null) {
                    if (!$file->isValid()) {
                        $errorString = $file->getErrorString();
                        $errorCode = $file->getError();
                    } else {
                        $savedPath = $file->store('../../public/img/promotion/education/'); //무조건 public 폴더에 저장해야함!!!! 안그럼 이미지 못불러옴
                        $fileInfo['file_name'] = $file->getName();
                        $fileInfo['real_name'] = $file->getClientName();
                        $fileInfo['file_size'] = $file->getSize();
                        $sql = 'INSERT INTO promotion_education_files (post_id, file_name, real_name, file_size) VALUES (?,?,?,?)';
                        $result = $db->query($sql, [$post_id, $fileInfo['file_name'], $fileInfo['real_name'],$fileInfo['file_size']]);
                    }
                }
            }
            if ($result != null) {
                $rs = "success";
                return $rs;
            }else{ return $rs; }
        }
        return $rs;
    }
