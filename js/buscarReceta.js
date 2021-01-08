new Vue({
    el:'#app',
    data:{
        url:"https://opticaweb.herokuapp.com/",
        rut:"",
        fecha:"",
        recetas:[],
        receta:{},
    },
    methods:{
        buscarRut: async function(){
            var recurso="controllers/BuscarRecetaxRut.php";
            var form = new FormData();
            form.append("rut",this.rut);
            try {
                const res = await fetch(this.url+recurso,{
                    method:"post",
                    body: form,
                });
                const data = await res.json();
                console.log(data);
                this.recetas=data;
            } catch (error) {
                console.log(error);
            }
        },
        abrirModal: function(receta){
            this.receta = receta;
            var modal = document.getElementById("detalle");
            var instance = M.Modal.getInstance(modal);
            instance.open();
        },

        buscarFecha: async function(){
            var recurso="controllers/BuscarRecetaxFecha.php";
            var form = new FormData();
            form.append('fecha',this.fecha);
            try {
                const res = await fetch(this.url+recurso,{
                    method: "post",
                    body: form,
                });
                const data = await res.json();
                console.log(this.fecha);
                console.log(data);
                this.recetas=data;
            } catch (error) {
                console.log(error);
            }
        },

        generarPDF: function(id){
            //alert(id);
            window.open(this.url+"controllers/ExportarPDF.php?id="+id,"_blank");
        }


    },
    created(){

    }
});