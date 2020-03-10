$(document).ready(function(){
    $("body").on("click", ".photo-pagination", function(){
        let limit = $(this).data("limit");
        let id = $(this).data("id");
        $.ajax({
            url: "models/photos/get_pagination.php",
            method: "GET",
            data: {
                limit: limit,
                id: id
            },
            success: function(data){
                console.log(data);
                printPhotos(data.photos,data.edit);
                printPagination(data.num_of_photos);
            },
            error: function(error){
                console.log(error);
            }
        })
        
    });
    $("#sort").change(function(){
        let sort = $(this).val();

        $.ajax({
            url: "models/photos/sorts.php",
            method: "POST",
            data: {
                sort: sort
            },
            dataType: 'json',
            success: function(photos){
                console.log(photos);
                printPhotos(photos.photos,photos.edit);
                printPagination(photos.num_of_photos);
            },
            error: function(error){
                console.log(error);
            }
        })
    });
    $("#search").keyup(function(){
        let search = $(this).val();

        $.ajax({
            url: "models/photos/filters.php",
            method: "POST",
            data: {
                search: search
            },
            dataType: 'json',
            success: function(photos){
                console.log(photos);
                printPhotos(photos.photos,photos.edit);
                printPagination(photos.num_of_photos);
            },
            error: function(error){
                console.log(error);
            }
        })
    });
    $(document).on("click", ".del", function(e){
        e.preventDefault();
        let id = $(this).data("id");
        
        $.ajax({
            url: "models/users/delete.php",
            method: "GET",
            data: {
                id: id
            },
            success: function(response){
                printUsers(response);
            },
            error: function(xhr, error, status){
                alert(error);
            }
        })
    });
});

function printPhotos(photos,edit){
    let html = "";
    for(let photo of photos){
        html += `<div class="col-md-4 col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        ${ photo.title }
                        </div>
                        <div class="panel-body">
                        <img src="${ photo.small }">
                        </div>
                        <div class="panel-footer">
                        <a href="index.php?page=post&id=${ photo.post_id }" class="btn btn-primary" >View post</a>
                        `;
    if(edit==1){
        html+=`<a href="index.php?page=insert&id=${ photo.post_id }" class="btn btn-warning">Edit</a>
            <a href="models/photos/delete.php?id=${ photo.post_id }" class="btn btn-danger">Delete</a>
            </div>
                    </div>
       </div>`;
    }else if(edit==photo.user_ids){
        html+=`<a href="index.php?page=insert&id=${ photo.post_id }" class="btn btn-warning">Edit</a>
            <a href="models/photos/delete.php?id=${ photo.post_id }" class="btn btn-danger">Delete</a>
            </div>
                    </div>
       </div>`;
    }else{
        html+=`</div>
        </div>
        </div>`;
    }
    }
    $("#photos").html(html);
}

function printPagination(num_of_photos){
    let html = " ";
    let name = document.getElementById('search').value;

    for(let i = 0; i < num_of_photos; i++){
        html += `<li class="paginate_button" aria-controls="dataTables-example" tabindex="0"><a href="#" class="photo-pagination" data-limit="${ i }" data-id="${name}" >${ i + 1 }</a></li>`;
    }
    $("#pagination").html(html);
}
function printUsers(response){
    let html = "";
    for(let respon of response){
        html += printUser(respon);
    }   
    $("#usus").html(html);
}
function printUser(respon){
    return `<tr>
    <td>${ respon.id }</td>
    <td>${ respon.uname }</td>
    <td>${ respon.username }</td>
    <td>${ respon.email }</td>
    <td>${ respon.role_id }</td>
    <td>
      <a href="index.php?page=register&id=${ respon.id }">Edit</a>
    </td>
    <td>
      <a href="#" data-id="${ respon.id }" class="del" >Delete</a>
    </td>
  </tr>`;
}

