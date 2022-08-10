//View
<select id="order" name="order[]" onchange="Order_myFunction(this.value)" >
    <?php for($o=1; $o <= count($p_val); $o++) { ?>
        <option <?php if($order == $o) {?> selected <?php } ?> value="<?=$num?>_<?=$o?>_<?=$order?>"><?=$o?></option>
    <?php } ?>
</select>

//js
function Order_myFunction(val) {
    $.ajax({
        type: "POST",
        url: "/admin/promotion/education_ajax",
        data: val,
        async : true,
        success:function(rs){
            if(rs === "success"){
                Swal.fire({title : '변경되었습니다.', icon: 'success'}).then((result) => { location.replace('/admin/promotion/education/'); });
            }else{
                Swal.fire({title : '실패', html: '다시 시도해 주세요.' ,icon: 'error'});
            }
        }
    });
}

//Controller
public function education_ajax() {

        $db = db_connect();
        $rs="failed";

        $order = $this->request->getPost();
        $aa = array_keys($order);

        $chg = explode('_',$aa[0]);  //(num)_(변경)_(현재) 이렇게 넘어옴
        $num = (int)$chg[0];
        $chg_order = (int)$chg[1]; //변경 될 순서(순위)
        $now_order = (int)$chg[2]; //현재 순서(순위)

        //현재 순서를 0으로 임시 저장
        $sql_1 = 'UPDATE promotion_education SET d_order = 0 WHERE num = ?';
        $result_1 = $db->query($sql_1,[$num]);

        if ($result_1 != null) {
            if ($chg_order < $now_order) { //아래에서 위로 올라갈 때 ex.5->3
                //변경되는 순서에 의해 변경되어야 하는 애들 업데이트
                $sql = 'UPDATE promotion_education SET d_order = d_order + 1 WHERE num in ( SELECT c.num FROM ( SELECT num FROM promotion_education WHERE ? <= d_order && d_order < ? ) AS c )';
                $result = $db->query($sql, [$chg_order, $now_order]);
                //현재 순서 변경 된 순서로 업데이트
                $sql_2 = 'UPDATE promotion_education SET d_order = ? WHERE num = ?';
                $result_2 = $db->query($sql_2, [$chg_order, $num]);

            } else { //위에서 아래로 내려갈 때 ex.1->3
                $sql = 'UPDATE promotion_education SET d_order = d_order - 1 WHERE num in ( SELECT c.num FROM ( SELECT num FROM promotion_education WHERE ? >= d_order && ? < d_order ) AS c )';
                $result = $db->query($sql, [$chg_order, $now_order]);
                $sql_2 = 'UPDATE promotion_education SET d_order = ? WHERE num = ?';
                $result_2 = $db->query($sql_2, [$chg_order, $num]);
            }

            if($result != null && $result_2 != null) {
                $rs = "success";
                return $rs;
            }else{
                return $rs;
            }
        }else{
            return $rs;
        }
    }
