class Product {
    constructor(app, json){
        this.buyCount = 0;
        this.app = app;
        
        json.price = parseInt(json.price.replace(/[^0-9]/, ""));
        this.json = json;
        
        this.init();
    }

    get totalPrice(){
        return this.buyCount * this.json.price;
    }

    init(){
        const {id, product_name, brand, photo, price} = this.json;
        
        this.id = id;
        this.product_name = product_name;
        this.brand = brand;
        this.photo = photo;
        this.price = price;

        return this;
    }

    storeUpdate(){
        const {id, photo, price} = this.json;       
        const {product_name, brand} = this;

        if(!this.$storeElem){
            this.$storeElem = $(`<div class="col-lg-4 col-md-6 mb-5">
                                    <div class="store-item">
                                        <div class="image rounded overflow-hidden" style="height: 300px;" data-id="${id}" draggable="draggable">
                                            <img src="/resources/images/products/${photo}" alt="상품 이미지" title="상품 이미지" class="fit-cover">
                                        </div>
                                        <div class="px-2 py-3 d-between">
                                            <div class="w-50">
                                                <div class="brand text-ellipsis text-muted fx-n2">${brand}</div>
                                                <div class="product_name text-ellipsis fx-2">${product_name}</div>
                                            </div>
                                            <div class="w-50 text-right text-ellipsis">
                                                <span class="fx-3 text-gold">${price.toLocaleString()}</span>
                                                <small class="text-muted">원</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>`);
        } else {
            this.$storeElem.find(".brand").html(brand);
            this.$storeElem.find(".product_name").html(product_name);
        }
    }

    cartUpdate(){
        const {id, product_name, brand, photo, price} = this.json;

        if(!this.$cartElem){
            this.$cartElem = $(`<div class="table-item">
                                    <div class="cell-50">
                                        <div class="text-left d-flex align-items-center">
                                            <img src="/resources/images/products/${photo}" alt="상품 이미지" width="80" height="80">
                                            <div class="px-4" style="width: calc(100% - 80px)">
                                                <span class="text-muted text-ellipsis">${brand}</span>
                                                <div class="fx-2 text-ellipsis">${product_name}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cell-15 text-ellipsis">
                                        <span>${price.toLocaleString()}</span>
                                        <small class="text-muted">원</small>
                                    </div>
                                    <div class="cell-10">
                                        <input type="number" class="buy-count" min="1" value="${this.buyCount}" data-id="${id}">
                                    </div>
                                    <div class="cell-15 text-ellipsis">
                                        <span class="total">${this.totalPrice.toLocaleString()}</span>
                                        <small class="text-muted">원</small>
                                    </div>
                                    <div class="cell-10">
                                        <button class="remove px-2 py-1 bg-blue text-white" data-id="${id}">×</button>
                                    </div>
                                </div>`);
        } else {
            this.$cartElem.find(".buy-count").val(this.buyCount);
            this.$cartElem.find(".total").text(this.totalPrice.toLocaleString());
        }
    }
}