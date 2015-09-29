var datatablePackage = {
    datatable:{
        init: function (columns, url) {
            var element = $("#table");
            element.DataTable({
                bLengthChange: false,
                processing: true,
                serverSide: true,
                ajax: url,
                columns: columns
            });
        }
    }

};

$.extend(true, Kacana, datatablePackage);