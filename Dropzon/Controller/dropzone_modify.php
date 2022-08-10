public function education_modify($num){

        $session = session();
        $model = new PromotionEducationModel();
        $files_model = new PromotionEducationFilesModel();

        $my_id = $session->get('id');
        if($my_id == null){
            return $this->response->redirect("/admin/login/");
        }else{
            $model->where('num', $num)->select('post_id, title');
            $md_val = $model->get();
            $get_max = $md_val->getResultArray();
            $title = $get_max[0]['title'];
            $post_id = (int)$get_max[0]['post_id'];

            $files_model->where('post_id', $post_id)->select('file_name,real_name,file_size');
            $query = $files_model->get();

            $file_val = [];
            foreach ($query->getResult() as $row) {
                $file_data['file_name'] = $row->file_name;
                $file_data['real_name'] = $row->real_name;
                $file_data['file_size'] = $row->file_size;
                array_push($file_val, $file_data);
            }

            return view("/admin/promotion/dropzone_modify", [
                'my_id' => $my_id,
                'file_val' => json_encode($file_val,true),
                'title' => $title,
                'post_id' => $post_id
            ]);
        }
    }
