import React, { Component } from "react";
import axios from "axios";
import $ from "jquery";
import Toast from "../component/Toast";

class Order extends Component {
    constructor() {
        super();
        this.state = {
            order: [],
            id: "",
            id_alamat: "",
            id_user: "",
            total: "",
            bukti_bayar: null,
            status: "",
            action: "",
            message: ""
        }
        //jika tidak terdapat data token pada lokal storage
        if (!localStorage.getItem("Token")) {
            // direct ke halaman login
            window.location = "/login";
        }
    }
    bind = (event) => {
        this.setState({ [event.target.name]: event.target.value });
    }

    bindImage = (e) => {
        this.setState({ image: e.target.files[0] })
    }
    // fungsi untuk membuka form tambah data

    get_order = () => {
        // $("#loading").toast("show");
        let url = "http://localhost/tokonline/public/orders";
        axios.get(url)
            .then(response => {
                this.setState({ order: response.data.order });
                $("#loading").toast("hide");
            })
            .catch(error => {
                console.log(error);
            });
    }

    Accept = (id_orders) => {
        if (window.confirm("Apakah anda yakin ingin menerima orderan ini?")){
            $("#loading").toast("show");
            let url = "http://localhost/tokonline/public/orders/accept/" + id_orders;
            axios.post(url)
            .then(response => {
                $("#loading").toast("hide");
                this.setState({message: response.data.message});
                $("message").toast("show");
                this.get_order();
            })
            .catch(error => {
                console.log(error);
            });
        }
    }

    Decline = (id_orders) => {
        if (window.confirm("Apakah anda yakin ingin menolak orderan ini?")){
            $("#loading").toast("show");
            let url = "http://localhost/tokonline/public/orders/decline/" + id_orders;
            axios.post(url)
            .then(response => {
                $("#loading").toast("hide");
                this.setState({message: response.data.message});
                $("message").toast("show");
                this.get_order();
            })
            .catch(error => {
                console.log(error);
            });
        }
    }
    
    componentDidMount = () => {
        this.get_order();

    }
    
    search = (event) => {
        if (event.keyCode === 13) {
            // $("#loading").toast("show");
            let url = "http://localhost/online.shop/public/product";
            let form = new FormData();
            form.append("find", this.state.find);
            axios.post(url, form)
                .then(response => {
                    $("#loading").toast("hide");
                    this.setState({ product: response.data.product });
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
    render() {
        return (
            <div className="container">
                <div className="card mt-2">
                    {/* header card */}
                    <div className="card-header bg-dark">
                        <div className="row">
                            <div className="col-sm-8">
                                <h4 className="text-white">Data Order</h4>
                            </div>

                        </div>

                    </div>
                    {/* content card */}
                    <div className="card-body">
                        <Toast id="message" autohide="true" title="Informasi">
                            {this.state.message}
                        </Toast>
                        <Toast id="loading" autohide="false" title="Informasi">
                            <span className="fa fa-spin faspinner"></span> Sedang Memuat
                        </Toast>
                        <table className="table">
                            <thead>
                                <tr>
                                    <th>ID User</th>
                                    <th>ID Address</th>
                                    <th>Total</th>
                                    <th>Bukti bayar</th>
                                    <th>Status</th>
                                    <th>Detail Order</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>

                                {this.state.order.map((item, index) => {
                                    return (
                                        <tr key={index}>
                                            <td>{item.id_user}</td>
                                            <td>{item.id_alamat}</td>
                                            <td>{item.total}</td>
                                            <td>{item.bukti_bayar}</td>
                                            <td>{item.status}</td>
                                            <td>
                                                {item.detail.map((it) => {
                                                    return (
                                                        <ul key={it.id_orders}>
                                                            <li>
                                                                {it.nama_product}
                                                                ({it.quantity})
                                                            </li>
                                                        </ul>
                                                    )
                                                })}
                                            </td>
                                            <button className="m-1 btn btn-sm btn-success"
                                                onClick={() => this.Accept(item.id)}>
                                                <span>Accept</span>
                                            </button>
                                            <button className="m-1 btn btn-sm btn-danger"
                                                onClick={() => this.Decline(item.id)}>
                                                <span>Decline</span>
                                            </button>

                                        </tr>
                                    );
                                })}
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>


        );
    }
}
export default Order