//select_first
$val = $model->where('num', $num)->first();
$file_name = $val['file_name'];



//select_where
$model->where('num',$num)->select('project')->find();
$project = $query[0]['project'];



//selectAll
$project = $model->find($num);



//selectMax
$get_max = $model->selectMax('post_id')->find();
$post_id = (int)$get_max[0]['post_id'];



//insert _ 특정 data insert
$data = ['post_id' => $post_id, 'title' => $title];
$model->insert($data);



//update
$data = [
  'num'           => $num,
  'project'       => $project,
  'name'          => $n_name,
  'part'          => $n_part,
  'part_detail'   => $n_part_detail,
  'charge'        => $charge
];
$result = $model->update($num, $data);  //OR => $model->set($data)->where('num',$num)->update();
if (!empty($result)) {
  $this->response->redirect("/---");
}



//delete
$model->where('num', $num)->delete();

