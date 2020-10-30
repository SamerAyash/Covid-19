<template>
    <div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">جدول المستخدمين</h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body table-responsive">
                        <div  class="form-group float-left w-25">
                            <label for="exampleInputEmail1">البحث</label>
                            <input type="text" @input="searchMethod()" class="form-control" id="exampleInputEmail1"
                                   v-model="search"  placeholder="رقم الهوية أو الاسم">
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>رقم الهوية</th>
                                <th>تاريخ التسجيل</th>
                                <th>رمز QR</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in users" :key="user.id">
                                <td>{{user.name}}</td>
                                <td>{{user.id_number}}</td>
                                <td>{{user.date}}</td>
                                <td>
                                    <a :href="'/dashboard/userQr/qr/'+user.id" target="_blank"><button class="btn btn-info">عرض</button></a>
                                </td>
                                <td>
                                    <button class="btn btn-danger" @click="deleteUser(user.id)">
                                        <i class="fas fa-trash-alt">حذف</i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li v-for="link in links" class="page-item" :class="link.active?'active':''" :key="link.label">
                                    <a class="page-link" @click.prevent="getusers(link.url)">
                                        {{link.label}}
                                        <span class="sr-only">{{link.active?'(current)':''}}
                                    </span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "UserQrComponent",
    data(){
        return {
            users: null,
            links: null,
            search:null,
        }
    },
    mounted() {
        this.getusers();
    },
    methods:{
        getusers(url = '/dashboard/get_usersQr'){
            axios.get(url)
                .then(res=>{
                    console.log(res)
                    this.users=res.data.data;
                    this.links=res.data.links;
                })
                .catch(err=>{
                    console.log(err);
                })
        },
        deleteUser(id){
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من التراجع عن هذا!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم, احذف العنصر'
            }).then((result) => {
                if (result.value) {
                    axios.delete('/dashboard/user/qr/'+id)
                        .then(res=>{
                            this.users.splice(this.users.map(el=> {return el.id;}).indexOf(id), 1);
                            Swal.fire(
                                'تم الحذف !',
                                'العنصر تم حذفه بنحاح.',
                                'success'
                            )
                        })
                        .catch(err=>{
                            console.log(err)
                        })
                }
            })
        },
        searchMethod(){
            axios.get('/dashboard/userQr/search/'+this.search)
                .then(res=>{
                    this.users=res.data.data;
                    this.links=res.data.links;
                })
                .catch(err=>{
                    console.log(err);
                })
        }
    }
}
</script>

<style scoped>

</style>
