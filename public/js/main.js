"use strict";

$(function() {
  // input file
  // クリックしたときにinputを発生させる。
  $(".file__btn").on("click", function() {
    $(".file__input").click();
  })
  // ファイルの値が変わった時にその値に変更する
  $(".file__input").on("change", function() {
    let val = $(this).prop("files")[0].name;
    $(".file__btn").text(val);
  })
})

// articleDetail.blade.php
// メニューの開閉
const MENU = document.querySelector(".menu");
const MENU_LINKS = document.querySelector(".menu__links");
if(MENU) {
  MENU.addEventListener("click", () => {
    MENU_LINKS.classList.toggle("active");
  })
}

// ログアウト処理
const icon = document.getElementById("icon");
const btn = document.getElementById("btn");
/**
 * ログアウト確認ダイアログ
 * 
 * @returns bool
 */
const check_logout = function() {
  if(confirm("ログアウトしますか？")) {
    return true;
  } else {
    return false;
  }
}
const submit = function() { //iconをクリックしたときにsubmitをする
  btn.click();
}
// iconのクリックと連動してsubmitをさせるようにイベントを登録
if(icon) {
  icon.addEventListener("click", submit);
}

// 非同期コメント投稿処理
const comment = document.getElementById("comment");
const token = document.getElementsByName("_token");
function htmlspecialchars(str) {
  return (str + '').replace(/&/g,'&amp;')
                  .replace(/"/g,'&quot;')
                  .replace(/'/g,'&#039;')
                  .replace(/</g,'&lt;')
                  .replace(/>/g,'&gt;') 
                  .replace(/\r\n|\r|\n/g, '<br>');
}
if(comment) {
  comment.addEventListener("click", () => {
    const post_data = new FormData;
    post_data.set("articles_id", document.getElementById("articles_id").value);
    post_data.set("users_id", document.getElementById("users_id").value);
    post_data.set("body", document.getElementById("body").value);
  
    fetch("/articleDetail/comment", {
      method: "POST",
      headers: {"X-CSRF-TOKEN": token[0].value},
      body: post_data
    })
      .then(response => response.json())
      .then(res => {
        const comment__inner = document.getElementById("comment__inner");
        comment__inner.insertAdjacentHTML("afterbegin",
          `<div class='comment__comments'>
            <div class='article__user'>
              <div class='article__user-link'><img class='article__user-img' src='/storage/${res[0].imgPath}'></div>
            </div>
            <div class='comment__body'>
              <div class='comment__body-head'>
                <p class="comment__user">${res[0].name}</p>
                <time class="comment__time">${res[0].created_at}</time>
              </div>
              <p class="comment__body-message">${htmlspecialchars(res[0].body)}</p>
            </div>

              <div class="comment__delete">
                <input type="hidden" name="_token" value="${token[0].value}">
                <input type="hidden" name="comments_id" value="${res[0].id}" class="comment__delete-input">
                <i class="fa-solid fa-trash-can trash"></i>
              </div>
            
          </div>`
          );
          document.getElementById("body").value = "";
          let comment_count = document.getElementById("comment_count").textContent;
          document.getElementById("comment_count").textContent = Number(comment_count) + 1;
          document.addEventListener("click", (e) => {
            if(e.target && e.target.classList.contains("trash")) {
              const POST_DATA = new FormData;
              POST_DATA.set("id", e.target.parentNode.querySelector(".comment__delete-input").value);
          
              fetch("/commentDelete", {
                method: "POST",
                headers: {"X-CSRF-TOKEN": token[0].value},
                body: POST_DATA
              })
              .then(response => response.json())
              .then(res => {
                e.target.closest(".comment__comments").style.display = "none"; 
                let comment_count = document.getElementById("comment_count").textContent;
                document.getElementById("comment_count").textContent = Number(comment_count) - 1;
              })
              .catch(error => console.error(error))
            }
          })
      })
      .catch(error => 
        console.error(error)
      )
  })
}

// 非同期コメント削除機能
const TRASH = document.querySelectorAll(".trash");
if(TRASH) {
  for(let i = 0; i < TRASH.length; i++) {
    TRASH[i].addEventListener("click", () => {
      const POST_DATA = new FormData;
      POST_DATA.set("id", document.querySelectorAll(".comment__delete-input")[i].value);
  
      fetch("/commentDelete", {
        method: "POST",
        headers: {"X-CSRF-TOKEN": token[0].value},
        body: POST_DATA
      })
      .then(response => response.json())
      .then(res => {
        document.querySelectorAll(".comment__delete-input")[i].closest(".comment__comments").style.display = "none"; 
        let comment_count = document.getElementById("comment_count").textContent;
        document.getElementById("comment_count").textContent = Number(comment_count) - 1;
      })
      .catch(error => console.error(error))
    })
  }
}

  // 非同期いいね機能
const LIKE = document.querySelectorAll(".like");
if(LIKE) {
  for(let i = 0; i < LIKE.length; i++) {
    LIKE[i].addEventListener("click", () => {
      const POST_DATA = new FormData;
      POST_DATA.set("articles_id", document.querySelectorAll(".article_id")[i].value);
  
      fetch("/like", {
        method: "POST",
        headers: {"X-CSRF-TOKEN": token[0].value},
        body: POST_DATA
      })
      .then(response => response.json())
      .then(res => {
        const STAR = document.querySelectorAll(".star")[i];
        const LIKE_COUNT = document.querySelectorAll(".like_count")[i];
        STAR.classList.toggle("active");
        LIKE_COUNT.textContent = res["like_count"];
      })
      .catch(error => 
        console.error(error)
      )
    })
  }
}

