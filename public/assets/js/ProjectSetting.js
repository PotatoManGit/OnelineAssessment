/**
 * 多选框判断，嫖的
 */
function getCheckbox(name) {
    obj = document.getElementsByName(name);
    check_val = [];
    for (k in obj) {
        if (obj[k].checked)
            check_val.push(obj[k].value);
    }
    return check_val;
}


function step01() {
    var name = $('#name').val();
    var startAt = $('#start_at').val();
    var endAt = $('#end_at').val();
    var process = $('#process').val();
    var status = $('#status').val();
    var khClass = getCheckbox('kh-class').toString()

    if(name === "" || startAt === "" || endAt === "" || process === "" || status === "" || khClass === "")
    {
        return false;
    }
    else
    {
        document.cookie='P_name=' + name;
        document.cookie='P_start_at=' + startAt;
        document.cookie='P_end_at=' + endAt;
        document.cookie='P_process=' + process;
        document.cookie='P_kh_class=' + khClass;
        document.cookie='P_kh_status=' + status;
        return true;
    }
}

function step02(num) {
    num = Number(num);

    var last = $('#data-show').val();
    var data_name = $('#data-name').val();
    var data_type = $('#data-type').val();

    if(data_name === "" || data_type === "")
    {
        return false;
    }

    last = last + num + '数据条目名：' + data_name + '\n';
    $('#data-show').val(last);
    $('#num').val(num + 1);

    document.cookie='P_dataName_' + num + '='+ data_name;
    document.cookie='P_dataType_' + num + '='+ data_type;

    return true;
}
