<template>
    <div>

    </div>
</template>

<script>
import swal from "sweetalert";
 export default {

    created(){
        if (this.$page.props.flash.success ) {
             swal({
                title: 'نجاح',
                text:this.$page.props.flash.success,
                icon: 'success',
                buttons: false,
                timer: 3000,
            });
        }
        if (this.$page.props.flash.error) {

            swal({
                title: 'حدث خطا ما',
                text: this.$page.props.flash.error,
                icon: 'error',
                buttons: false,
                timer: 3000,
            });
        }
    },
    watch: {
        '$page.props.flash': {
            handler() {
                if (this.$page.props.flash.success) {
                         swal({
                           title: 'نجاح',
                             text:this.$page.props.flash.success,
                             icon: 'success',
                             buttons: false,
                             timer: 3000,
                        });


                }
                if (this.$page.props.flash.error) {

                         swal({
                           title: 'حدث خطا ما',
                            text: this.$page.props.flash.error,
                            icon: 'error',
                            buttons: false,
                            timer: 3000,
                        });

                }
                // this.show = true
            },
           // deep: true,
        },
    },
}
</script>
