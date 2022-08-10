public function education_modify_upload(){

        $db = db_connect();
        $model = new PromotionEducationModel();
        $files_model = new PromotionEducationFilesModel();
        $rs = "success";

        $post_id = $this->request->getPost('post_id');
        $title = $this->request->getPost('title');
        $files = $this->request->getFileMultiple("file");
        $dlt_val = $this->request->getPost('delete_name');

        if( $files == null && $title == null && $dlt_val == null){
            return $rs;
        }

        $title_result = $model->set('title',$title)->where('post_id',$post_id)->update();
        if($title_result == null ){
            $rs = "failed";
            return $rs;
        }

        if( $dlt_val != null ){
            $jbexplode = explode( ',', $dlt_val );
            for($i=0; $i < count($jbexplode) ; $i++){
                $files_model->where('file_name', $jbexplode[$i])->delete();
            }
        }

        if( $files != null ){
            foreach ($files as $file) {
                $fileInfo = [];
                if ($file != null) {
                    if (!$file->isValid()) {
                        $errorString = $file->getErrorString();
                        $errorCode = $file->getError();
                    } else {
                        $savedPath = $file->store('../../public/img/promotion/education/');
                        $fileInfo['file_name'] = $file->getName();
                        $fileInfo['real_name'] = $file->getClientName();
                        $fileInfo['file_size'] = $file->getSize();
                        $sql = 'INSERT INTO promotion_education_files (post_id, file_name, real_name, file_size) VALUES (?,?,?,?)';
                        $result = $db->query($sql, [$post_id, $fileInfo['file_name'], $fileInfo['real_name'], $fileInfo['file_size']]);

                    }
                }
            }
            if ($result == null) {
                $rs = "failed";
                return $rs;
            }
        }
        return $rs;
    }
