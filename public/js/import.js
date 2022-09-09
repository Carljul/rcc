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
