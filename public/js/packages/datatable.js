var datatablePackage = {
    datatable:{
        init: function (eid, columns, url) {
            column_arr = [];
            for (var i=0; i<columns.length; i++) {
                column_arr.push({
                    data:columns[i],
                    name:columns[i]
                });
            }
            $("#"+eid).DataTable({
                bLengthChange: false,
                aTargets: ['nosort'],
                processing: true,
                serverSide: true,
                ajax: url,
                columns: column_arr
            });
        }
    }

};

$.extend(true, Kacana, datatablePackage);