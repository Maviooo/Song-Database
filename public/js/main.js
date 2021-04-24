window.onload = function(){
    var songs = document.getElementById('songTable');
    if(songs) { 
        songs.addEventListener('click', (e) => {
            if(e.target.className === 'btn btn-danger delete-song') {
                if(confirm('Are you sure?')) {
                    const id = e.target.getAttribute('data-id');
                    fetch(`/song/delete/${id}`, {
                        method: 'DELETE'
                    }).then(res=> window.location.reload());
                }
            }
        });
    }
}