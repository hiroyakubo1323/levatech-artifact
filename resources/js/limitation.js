function limit() {
    var count = 0;
    for (var i=0; i<3; i++) {
        if (document.emotions_array[i].checked) {
            count++;
        }
    }

    if(count>=3){ //チェックの合計数が制限数になれば
        for (i=0; i<emotions_array.length; i++){
        if(emotions_array[i].checked) {
           emotions_array[i].disabled =false;
        }
        else {
            emotions_array[i].disabled =false;}
        }
    } else {
        for (i=0; emotions_array.length; i++) {
            emotions_array[i].disabled =false;
        }
    }
}

