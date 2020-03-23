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
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Address</th>
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
                                            <td>{item.id}</td>
                                            <td>{item.name}</td>
                                            <td>{item.jalan}</td>
                                            <td>{item.total}</td>
                                            <td>{item.bukti_bayar}</td>
                                            <td>{item.status}</td>
                                            <td>{item.detail_order}</td>
                                            <button className="m-1 btn btn-sm btn-success" onClick={() => this.Edit(item)}>
                                                <span>Accept</span>
                                            </button>
                                            <button className="m-1 btn btn-sm btn-danger"
                                                onClick={() => this.Drop(item.id)}>
                                                <span>Decline</span>
                                            </button>

                                        </tr>
                                    );
                                })}
                            </tbody>
                        </table>

                        {/* tombol tambah */}
                    </div>
                </div>


            </div>


        );
    }
}
export default Order