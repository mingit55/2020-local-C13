</header>

<div class="text-center pb-5">
    <span class="text-muted">전문가 소개</span>
    <div class="title">EXPERTS</div>
</div>
<div class="bg-gold position-relative mt-4 mb-5">
    <div class="container">
        <div class="row">
            <?php foreach($experts as $expert):?>
            <div class="expert-item col-lg-3 col-6 mb-4">
                <div class="inner">
                    <div class="front">
                        <img src="/uploads/users/<?=$expert->photo?>" alt="전문가 이미지" title="전문가 이미지" class="fit-cover">
                    </div>
                    <div class="back d-flex flex-column-reverse py-4 bg-white">
                        <div class="d-flex align-items-center flex-column">
                            <span class="fx-2"><?=$expert->user_name?></span>
                            <small class="text-gold">(<?=$expert->user_id?>)</small>
                            <div class="my-3 text-gold">
                                <i class="fa fa-star"></i>
                                <?=$expert->score?>
                            </div>
                            <hr style="width: 50px;">
                            <button class="px-4 py-2 text-white bg-blue" data-target="#review-modal" data-toggle="modal" data-id="<?=$expert->id?>">시공 후기작성</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</div>

<div class="bg-gray">
    <div class="container padding">
        <div class="sticky-top pt-4 bg-gray">
            <div>
                <span class="text-muted">전문가 시공후기</span>
                <div class="title">REVIEWS</div>
            </div>
            <div class="table-head mt-3">
                <div class="cell-15">전문가 정보</div>
                <div class="cell-40">내용</div>
                <div class="cell-15">작성자</div>
                <div class="cell-15">비용</div>
                <div class="cell-15">평점</div>
            </div>
        </div>
        <div class="list">
            <?php foreach($reviews as $review):?>
                <div class="table-item">
                <div class="cell-15">
                    <span><?=$review->e_name?></span>
                    <small class="text-muted"><?=$review->e_id?></small>
                </div>
                <div class="cell-40">
                    <p class="text-muted fx-n2"><?=nl2br(htmlentities($review->contents))?></p>
                </div>
                <div class="cell-15">
                    <span><?=$review->user_name?></span>
                    <small class="text-muted"><?=$review->user_id?></small>
                </div>
                <div class="cell-15">
                    <span><?=number_format($review->price)?></span>
                    <small class="text-muted">원</small>
                </div>
                <div class="cell-15 text-gold">
                    <i class="fa fa-star"></i>
                    <?=$review->score?>
                </div>
            </div>
            <?php endforeach;?>
        </div>
    </div>
</div>

<div id="review-modal">
    <form action="/experts/reviews" method="post">
        <input type="hidden" id="eid" name="eid">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body pt-4 pb-3 px-4">
                    <div class="text-center title">REVIEW</div>
                    <div class="mt-4">
                        <div class="form-group">
                            <label for="price">비용</label>
                            <input type="number" id="price" class="form-control" min="0" value="10000" required>
                        </div>
                        <div class="form-group">
                            <label for="score">평점</label>
                            <select name="score" id="score" class="form-control">
                                <option value="1">1점</option>
                                <option value="2">2점</option>
                                <option value="3">3점</option>
                                <option value="4">4점</option>
                                <option value="5">5점</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contents">내용</label>
                            <textarea name="contents" id="contents" cols="30" rows="10" placeholder="내용을 입력하세요" required></textarea>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="py-3 w-100 text-white bg-blue">작성 완료</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(function(){
        $("[data-target='#review-modal']").on("click", function(){
            $("#eid").val(this.dataset.id);
        });
    });
</script>