"use strict";

const ELEMENT_FILE_BTN = document.querySelector(".file__btn");
const ELEMENT_FILE_INPUT = document.querySelector(".file__input");

/**
 * 要素をクリックしたときinputをクリックしたとする
 */
const fileInputClick = () => {
  ELEMENT_FILE_INPUT.click();
}

/**
 * inputのvalueが変わった時に別の要素のテキストを変更する
 */
const changeFileName = () => {
  let file_name = ELEMENT_FILE_INPUT.value;
  ELEMENT_FILE_BTN.textContent = file_name;
}

if(ELEMENT_FILE_BTN) {
  ELEMENT_FILE_BTN.addEventListener("click", fileInputClick);
  ELEMENT_FILE_INPUT.addEventListener("change", changeFileName);
}

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

/**
 * 非同期メッセージ機能
 */
const MESSAGE_ICON = document.querySelector(".message__icon");
const TALK_USER_WRAP = document.querySelectorAll(".talk__userWrap");
const LAST = TALK_USER_WRAP.length;
if(TALK_USER_WRAP.length != 0) {
  TALK_USER_WRAP[LAST - 1].scrollIntoView({behavior: "auto", block: "start"});
}
if(MESSAGE_ICON) {
  MESSAGE_ICON.addEventListener("click", () => {
    const BODY = document.querySelector(".message__txt");
    const SEGMENTER = new Intl.Segmenter("ja", {granularity: "grapheme"});
    const SEGMENTS = SEGMENTER.segment(BODY.value);
    let error = [];
    if(BODY.value == "") {
      error.push("メッセージを入力してください。");
    }
    if(/.*(ばか|あほ|しね).*.*/.test(BODY.value)) {
      error.push("不適切な文字が含まれています。");
    }
    if([...SEGMENTS].length > 250) {
      error.push("文字数は250文字までです。");
    }
    if(error.length == 0) {
      const POST_DATA = new FormData;
      POST_DATA.set("room_id", document.querySelector(".room_id").value);
      POST_DATA.set("user_id", document.querySelector(".user_id").value);
      POST_DATA.set("message", BODY.value);
      fetch("/send", {
        method: "POST",
        headers: {"X-CSRF-TOKEN": token[0].value},
        body: POST_DATA
      })
      .then(response => response.json())
      .then(res => {
        const TALK_WRAP = document.querySelector(".talk__wrap");
        TALK_WRAP.insertAdjacentHTML("beforeend",
          `<div class="talk__userWrap talk__userWrap--reverse">
            <div class="talk__body talk__body--reverse">
              <p class="talk__message talk__message--reverse">${htmlspecialchars(res.message)}</p>
              <time class="talk__message-time">${res.created_at}</time>
            </div>
            <form class="talk__delete" method="POST">
              <input type="hidden" name="_token" value="${token[0].value}">
              <input type="hidden" name="id" value="${res.id}">
              <button class="talk__delete-btn"><i class="fa-solid fa-trash-can talk__delete-icon"></i></button>
            </form>
          </div>`
        );
        BODY.value = "";
        const TALK_USER_WRAP = document.querySelectorAll(".talk__userWrap");
        const LAST = TALK_USER_WRAP.length;
        TALK_USER_WRAP[LAST - 1].scrollIntoView({behavior: "smooth", block: "start"});
        "mousedown touchstart".split(" ").forEach((eventName) => { 
          TALK_USER_WRAP[LAST - 1].children[0].children[0].addEventListener(`${eventName}`, (e) => {
            e.preventDefault();
            timer = setTimeout(function() {
              e.target.closest(".talk__userWrap").lastElementChild.classList.add("active");
            }, BUTTON_TAP_TIME);
          })
        })
        "mouseup touchend".split(" ").forEach((eventName) => {
          TALK_USER_WRAP[LAST - 1].children[0].children[0].addEventListener(`${eventName}`, (e) => {
            clearTimeout(timer);
          }); 
        })
        const TALK_DELETE = document.querySelectorAll(".talk__delete");
        document.addEventListener("click", (e) => {
          if(!e.target.closest(".talk__delete")) {
            for(let i = 0; i < TALK_DELETE.length; i++) {
              TALK_DELETE[i].classList.remove("active");
            }
          };
        });
        multipleDeleteEventListener("submit", TALK_DELETE);
      })
      .catch(error => console.error(error));
    } else {
      alert(error);
    }
  })
}

/**
 * メッセージ削除機能
 */
// クリック長押しで削除を表示
const TALK_MESSAGE = document.querySelectorAll(".talk__message");
const BUTTON_TAP_TIME = 1000;
let timer;
for(let i = 0; i < TALK_MESSAGE.length; i++) {
  "mousedown touchstart".split(" ").forEach((eventName) => {
    TALK_MESSAGE[i].addEventListener(`${eventName}`, (e) => {
      e.preventDefault();
      timer = setTimeout(function() {
        e.target.closest(".talk__userWrap").lastElementChild.classList.add("active");
      }, BUTTON_TAP_TIME);
    });
    "mouseup touchend".split(" ").forEach((eventName) => {
      TALK_MESSAGE[i].addEventListener(`${eventName}`, (e) => {
        clearTimeout(timer);
      }); 
    })
  });
}

// 削除以外を押した時の処理
const TALK_DELETE = document.querySelectorAll(".talk__delete");
document.addEventListener("click", (e) => {
  if(!e.target.closest(".talk__delete")) {
    for(let i = 0; i < TALK_DELETE.length; i++) {
      TALK_DELETE[i].classList.remove("active");
    }
  };
});

/**
 * フォームデータの作成
 * 
 * @param {Element} element 
 * @returns {object} DATA
 */
function createDeleteFormData(element) {
  const DATA = new FormData;
  DATA.set("id", element.id.value);
  return DATA;
}

/**
 * 非同期通信
 * 
 * @param {string} url 
 * @param {object} param1 
 */
function asynchronous(url, {data, token}) {
  fetch(url, {
    method: "POST",
    headers: {"X-CSRF-TOKEN": token},
    body: data
  })
  .then(response => response.json())
  .then(res => {
    return res;
  })
  .catch(error => console.error(error));
}

/**
 * 削除した要素を隠す
 * 
 * @param {Element} element 
 */
function displayNone(element) {
  console.log(element);
  element.style.display = "none";
}

/**
 *メッセージの削除
 * 
 * @param {string} type 
 * @param {Array} listener 
 */
function multipleDeleteEventListener(type, listener) {
  for(let i = 0; i < listener.length; i++) {
    listener[i].addEventListener(type, (e) => {
      e.preventDefault();
      e.stopPropagation();
      const POST_DATA = createDeleteFormData(e.target);
      const URL = "/messageDelete";
      asynchronous(URL,{data: POST_DATA, token: e.target._token.value});
      displayNone(e.target.closest(".talk__userWrap"));
    })
  }
}

multipleDeleteEventListener("submit", TALK_DELETE);

class Search {
  #SEGMENTER = new Intl.Segmenter("ja", {granularity: "grapheme"});
  #SEGMENTS;
  #errors = "";

  /**
   * 入力値のバリデーション
   * 
   * @param {string} keyword 
   * @returns {boolean} 
   */
  validate(keyword) {
    this.#SEGMENTS = this.#SEGMENTER.segment(keyword);
    if(keyword == "") {
      this.#errors += "キーワードを入力してください。\n";
    }
    if(keyword != "" && !keyword.match(/^[\u30a0-\u30ff\u3040-\u309f\u3005-\u3006\u30e0-\u9fcf]+$/)) {
      this.#errors += "ひらがな、カタカナ、漢字のみ使用できます。\n";
    }
    if([...this.#SEGMENTS].length > 10) {
      this.#errors += "文字数は10文字までです。\n";
    }
    if(this.#errors != "") {
      alert(this.#errors);
      this.#errors = "";
      return false;
    }
    return true;
  }

  /**
   * イベントリスナー
   * 
   * @param {string} type
   * @param {element} element
   * @returns {element}
   */
  setEventlistener(type, element) {
    element.addEventListener(type, (e) => {
      if(this.validate(e.target.search.value) == false) {
        e.preventDefault();
        e.stopPropagation();
      };
    })
  }
}

const ELEMENT_FORM_SEARCH = document.querySelector(".search");
if(ELEMENT_FORM_SEARCH) {
  const SEARCH = new Search();
  SEARCH.setEventlistener("submit", ELEMENT_FORM_SEARCH);
}

/**
 * adminのユーザー削除確認
 */
const checkDelete = (element) => {
  if(!confirm('削除しますか？')) {
    element.preventDefault();
    element.stopPropagation();
  }
}

const USER_DELETE = document.getElementById("userDelete");
/**
 *ユーザー削除のイベント
 */
if(USER_DELETE) {
  USER_DELETE.addEventListener("submit", (e) => {
    checkDelete(e);
  })
}


/**
 * ポストフォームのバリデーションのため
 * 
 * @type {element} POST_FORM
 */
const POST_FORM = document.getElementById("js-postForm");
if(POST_FORM) {
  POST_FORM.addEventListener("submit", (e) => {
    //クラスのみが選択されている時にアラートを出し、イベントを止める。
    if(e.target.grade.value == 0 && e.target.class.value != 0) {
      e.preventDefault();
      e.stopPropagation();
      alert("学年を選択してください。");
    }
  })
}