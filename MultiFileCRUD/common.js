
function Notice_Delete_Swal(num){
    $.ajax({
        type:"post",
        url:'/admin/notice/delete/'+num,
        data: num,
        processData: false,
        contentType: false,
        cache: false,
        success:function(rs){
            if(rs === "success"){
                Swal.fire({title : '삭제되었습니다.', icon: 'success'}).then((result) => { location.replace('/admin/notice'); });
            }else{
                Swal.fire({title : '삭제가 완료되지 않았습니다.', text:'다시 확인해주세요.', icon: 'error'}).then((result) => { location.replace('/admin/notice'); });
            }
        }
    });
}

function Notice_myFunction(val) {
    $.ajax({
        type: "POST",
        url: "/admin/notice/ajaxData",
        data: val,
        async : true,
        success:function(rs){
            if(rs === "success"){
                Swal.fire({title : '변경되었습니다.', icon: 'success'}).then((result) => { location.reload(); });
            }else{
                Swal.fire({title : '실패', html: '다시 시도해 주세요.' ,icon: 'error'});
            }
        }
    });
}
