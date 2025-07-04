import axios from 'axios';
window.axios = axios;

import '@fortawesome/fontawesome-free/css/all.min.css';
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import DataTable from 'datatables.net-dt';

window.DataTable = DataTable;

import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

window.toastr = toastr;
toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-bottom-center",
    "timeOut": "2000",
};
