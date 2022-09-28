let dropArea = document.getElementById('drop-area');

;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false)
})

function preventDefaults (e) {
    e.preventDefault()
    e.stopPropagation()
}

;['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, highlight, false)
})

;['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, unhighlight, false)
})

function highlight(e) {
    dropArea.classList.add('highlight')
}

function unhighlight(e) {
    dropArea.classList.remove('highlight')
}

dropArea.addEventListener('drop', handleDrop, false)

function handleDrop(e) {
    let dt = e.dataTransfer
    let files = dt.files

    handleFiles(files)
}

function handleFiles(files) {
    let list = [...files];
    createFileList(list)

    setTimeout(function(){
        if (localStorage.getItem('excels') != null) {
            let excels = JSON.parse(localStorage.getItem('excels'));

            if (excels.length == list.length) {
                uploadFile();
            }
        }
    },3000);
}

var parseExcel = function(file, id) {
    var reader = new FileReader();

    reader.onload = function(e) {
        var data = e.target.result;
        var workbook = XLSX.read(data, {
            type: 'binary'
        });

        workbook.SheetNames.forEach(function(sheetName) {
            // Here is your object
            var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
            var json_object = JSON.stringify(XL_row_object);
            var setJson = [{
                'id': id,
                'name': file.name,
                'data': JSON.parse(json_object)
            }];

            if (localStorage.getItem('excels') === null) {
                localStorage.setItem('excels', JSON.stringify(setJson));
            } else {
                let excels = JSON.parse(localStorage.getItem('excels'));
                excels.push(setJson[0]);
                localStorage.setItem('excels', JSON.stringify(excels));
            }
        })

    };

    reader.onerror = function(ex) {
        console.log(ex);
    };

    reader.readAsBinaryString(file);
};


function createFileList(files, fromStorage = false)
{
    let html = '';
    for (let i = 0; i < files.length; i++) {
        const element = files[i];
        let id = fromStorage ? element.id : Date.now();
        if (!fromStorage) {
            parseExcel(element, id);
        }
        html += `<tr id="`+id+`">
            <td>`+element.name+`</td>
            <td class="import-progress">
                Pending . . .
            </td>
        </tr>`;
    }

    $('#fileList tbody').html(html);

    $('#drop-area').addClass('hide');
    $('#progress-area').removeClass('hide');
}

function renderStorage() {
    if (localStorage.getItem('excels') != null) {
        let files = JSON.parse(localStorage.getItem('excels'));
        createFileList(files, true);
    }
}
renderStorage();


function withIssues()
{
    let issueCount = 0;
    let withIssues = [];
    if (localStorage.getItem('withIssues') === null) {
        issueCount = 0;
    } else {
        withIssues = JSON.parse(localStorage.getItem('withIssues'));
        issueCount = withIssues.length;
    }
    $('#withIssueImportButton span.badge').html(issueCount);

    if (withIssues.length > 0) {
        let html = '';
        for (let i = 0; i < withIssues.length; i++) {
            const element = withIssues[i];
            html += `<tr>
                <td>`+element.firstname+`</td>
                <td>`+element.middlename+`</td>
                <td>`+element.lastname+`</td>
                <td>`+element.extension+`</td>
                <td>`+element.gender+`</td>
                <td>`+element.birthdate+`</td>
                <td>`+element.address+`</td>
                <td>`+element.date_died+`</td>
                <td>`+element.date_internment+`</td>
                <td>`+element.time_internment+`</td>
                <td>`+element.expiry_date+`</td>
                <td>`+element.cause_of_death+`</td>
                <td>`+element.location+`</td>
                <td>`+element.vicinity+`</td>
                <td>`+element.area+`</td>
                <td>`+element.payer+`</td>
                <td>`+element.lease_amount+`</td>
                <td>`+element.amount+`</td>
                <td>`+element.contact_number+`</td>
                <td>`+element.or_number+`</td>
                <td>`+element.date_paid+`</td>
                <td>`+element.balance+`</td>
                <td>`+element.terms_of_payment+`</td>
                <td>`+element.remarks+`</td>
                <td>`+element.pasuga_payer+`</td>
                <td>`+element.pasuga_date_connection+`</td>
                <td>`+element.pasuga_expiry_date+`</td>
                <td>`+element.pasuga_amount+`</td>
                <td>`+element.pasuga_or_number+`</td>
            </tr>`;
        }
        $('#withIssueImport .modal-body table tbody').html(html);
    }
}

withIssues()