function updateTable(data, values) {
    const tbody = document.getElementById("student");
    const tr_stu = document.createElement("tr")
    tr_stu.setAttribute('id', data["id"])
    values.forEach(value => {
        let td_stu = document.createElement("td")
        if (typeof data[value] === 'object' && data[value] !== null) {
            td_stu.innerText = data[value]['name']
        }
        else
            td_stu.innerText = data[value];
        tr_stu.appendChild(td_stu);
    })
    var x = document.createElement("BUTTON");
    var t = document.createTextNode("Delete");
    x.appendChild(t);
    tr_stu.appendChild(x);
    x.addEventListener("click", function () { delete_student(data["id"]) });
    tbody.appendChild(tr_stu);
}

function updateSelect(data, values, id) {
    for (var i = 0; i < data.length; i++) {
        var s = document.getElementById(id);
        var o = document.createElement("option");
        values.forEach(value => {
            o.textContent = data[i][value]
        })
        s.appendChild(o);
    }
}
var total_page = null
per_page = null
name_stu = null
class_stu = null
page = ''
gen_stu = null
var current_page = null
var url = new URL('http://127.0.0.1:8000/api/student')
function Search() {
    const tbody = document.getElementById("student");
    tbody.innerHTML = ''
    url.search = ''
    value_class = class_stu.options[class_stu.selectedIndex].value
    value_gen = gen_stu.options[gen_stu.selectedIndex].value
    current_page = new URL(window.location.href)
    current_page.search = ''
    if (name_stu.value != '') {
        current_page.searchParams.append('name', name_stu.value)
    }

    if (value_class != '') {
        current_page.searchParams.append('class', value_class)
    }

    if (page != '') {
        current_page.searchParams.append('page', page)
    }

    if (value_gen != '') {
        current_page.searchParams.append('gender', value_gen)
    }
    document.location.href = current_page
}
const urlSearchParams = new URLSearchParams(window.location.search);
const params = Object.fromEntries(urlSearchParams.entries());

function fillData() {

    for (const property in params) {
        url.searchParams.append(property, params[property])
    }
    fetch(url, { method: "GET" }).then(function (response) {
        return response.json();
    }).then(function (res) {
        if (res.success) {
            var data = res.success
            total_page = res.total_page
            setPage(total_page)
            data.forEach(
                d => {
                    updateTable(d, ['id', 'name', 'gender', 'class'])
                }
            )
        }
        else
            console.log('k co')
    })
}

window.onload = () => {
    name_stu = document.getElementById('fname')
    if (params['name'])
        name_stu.value = params['name']
    class_stu = document.getElementById('Select')
    gen_stu = document.getElementById('Select_gen')
    fillData()
}


let dataArray;

fetch("http://127.0.0.1:8000/api/class").then(function (response) {
    return response.json();
}).then(function (res) {
    dataArray = res.success
    updateSelect(dataArray, ['id', 'name'], 'Select');
});

let dataArraygen;

fetch("http://127.0.0.1:8000/api/gender").then(function (response) {
    return response.json();
}).then(function (res) {
    dataArraygen = res.success
    updateSelect(dataArraygen, ['id', 'name'], 'Select_gen');
});

function setPage(total_page) {
    current_page = new URL(window.location.href)
    pagi = document.getElementById('pagi')
    pagi.innerHTML = ''
    for (var i = 0; i < total_page; i++) {
        const li_page = document.createElement("li")
        li_page.setAttribute('class', "page-item")
        let a_page = document.createElement("a")
        a_page.setAttribute('class', "page-link")
        a_page.href = click_page(i + 1)
        a_page.innerText = i + 1;
        li_page.appendChild(a_page);
        pagi.appendChild(li_page);
    }

}

function click_page(page) {
    current_page = new URL(window.location.href)
    current_page.searchParams.delete('page')
    current_page.searchParams.append('page', page)
    return current_page.toString()
}

function add_new_student() {
    url.search = ''
    fetch(url, { method: "POST" }).then(function (response) {
        return response.json();
    }).then(function (res) {
        console.log(res)
        if (res['success'])
            window.location.reload()
    });
}

function delete_student(id) {
    url.search = ''
    url = url + '/' + id
    fetch(url, { method: "DELETE" }).then(function (response) {
        return response.json();
    }).then(function (res) {
        window.location.reload()
    });
}

