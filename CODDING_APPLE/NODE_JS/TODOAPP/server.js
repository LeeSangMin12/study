const express = require("express");
const app = express();
const mongo_client = require("mongodb").MongoClient;
const methodOverride = require("method-override");
const passport = require('passport');
const LocalStrategy = require('passport-local').Strategy;
const session = require('express-session');
require('dotenv').config();


app.use(express.urlencoded({ extended: true }));
app.use(methodOverride("_method"));
app.set("view engine", "ejs");

app.use("/public", express.static("public"));
app.use(session({ secret: '비밀코드', resave: true, saveUninitialized: false }));
app.use(passport.initialize());
app.use(passport.session());

app.use("/shop", require("./routes/shop.js"));
app.use("/board/sub", require("./routes/board.js"));

passport.use(new LocalStrategy({
	usernameField: 'id',
	passwordField: 'pw',
	session: true,
	passReqToCallback: false,
}, function (입력한아이디, 입력한비번, done) {
	//console.log(입력한아이디, 입력한비번);
	db.collection('login').findOne({ id: 입력한아이디 }, function (에러, 결과) {
		if (에러) return done(에러)

		if (!결과) return done(null, false, { message: '존재하지않는 아이디요' })
		//애초에 DB에 pw를 저장할 때 암호화해서 저장하는 것이 좋으며
		//사용자가 입력한 비번을 암호화해준 뒤에 이게 결과.pw와 같은지 비교하는게 조금 더 보안에 신경쓴 방법 
		if (입력한비번 == 결과.pw) {
			return done(null, 결과)
		} else {
			return done(null, false, { message: '비번틀렸어요' })
		}
	})
}));


//id를 이용해서 세션을 저장시키는 코드(로그인 성공시 발동)
//세션 데이터를 만들고 세션의 id정보를 쿠키로 보냄
passport.serializeUser(function (user, done) {
	done(null, user.id);
});

//이 세션 데이터를 가진 사람을 db에서 찾아주세요(마이페이지 접속시 발동)
passport.deserializeUser(function (아이디, done) {
	db.collection('login').findOne({ id: 아이디 }, function (에러, 결과) {
		done(null, 결과)
		// 여기서 결과엔 { id : 입력한 id, pw : 입력한 pw, 이름 : 이름 } 등 내가 넣은 정보들이 저장
		// 결과에 담긴 데이터들은 app.get('/mypage')에서 요청.user (req.user) 에 담겨있음   
	})
});

let db;
mongo_client.connect(process.env.DB_URL, (err, client) => {
	db = client.db("todoapp");

	app.listen(process.env.PORT, () => {
		console.log(`listening on ${process.env.PORT}`);
	});
});
app.get("/login", (req, res) => {
	res.render("login.ejs");
});

app.get("/", (req, res) => {
	res.render("index.ejs");
});

app.get("/write", (req, res) => {
	res.render("write.ejs");
});

app.get("/list", (req, res) => {
	db.collection("post").find().toArray((err, result) => {
		res.render("list.ejs", { posts: result });
	});
});

const is_login = (req, res, next) => {
	if (req.user) {
		next();
	} else {
		res.send("로그인 안하셨습니다.");
	}
};

app.get("/mypage", is_login, (req, res) => {
	res.render("mypage.ejs", { 사용자: req.user });
});

app.get("/search", (req, res) => {
	db.collection("post").aggregate().toArray((err, result) => {
		const search_criterion = [
			{
				$search: {
					index: "titleSearch",
					text: {
						query: req.query.value,
						path: "제목"  //제목날짜 둘다 찾고 싶으면 ["제목", "날짜"]
					}
				}
			},
			//검색조건 넣는곳. 
			//숫자 1은 가져오지 않음
			//score은 많이 검색된 순위
			{ $project: { 제목: 1, _id: 0, score: { $meta: "searchScore" } } },
		];
		console.log(result);

		res.render("search.ejs", { posts: result });
	});
});

app.get("/detail/:id", (req, res) => {
	db.collection("post").findOne({ _id: parseInt(req.params.id) }, (err, result) => {
		res.render("detail.ejs", { data: result });
	});
});

app.get("/edit/:id", (req, res) => {
	db.collection("post").findOne({ _id: parseInt(req.params.id) }, (err, result) => {
		res.render("edit.ejs", { post: result });
	});
});

let multer = require("multer");
let storage = multer.diskStorage({
	destination : (req, file, cb) => {
		cb(null, "./public/image")  //저장할 이미지 경로
	},
	filename : (req, file, cb) => {
		cb(null, file.originalname)  //저장팔 파일 이름 - 기존명이랑 동일하게 설정
	}
});
app.get("/upload", (req, res) => {
	res.render("upload.ejs");
});
let upload = multer({storage : storage});

app.get("/image/:image_name", (req, res) => {
	//__dirname = 현재 파일 경로
	res.sendFile(  __dirname  + "/public/image/" + req.params.image_name);
});

app.post("/upload", upload.single("profile"), (req, res	) => {
	res.send("업로드완료")
});

app.post("/add", (req, res) => {
	res.send("전송완료");
	db.collection("counter").findOne({ name: "게시물갯수" }, (err, result) => {
		const total_post_num = result.total_post;

		const save_writing_info = { _id: total_post_num + 1, 작성자: req.user.id, 제목: req.body.title, 날짜: req.body.date };

		db.collection("post").insertOne(save_writing_info, (err, res) => {
			db.collection("counter").updateOne({ name: "게시물갯수" }, { $inc: { total_post: 1 } }, (err, result) => {
				if (err) { return console.log(err); }
			});
		});
	});
});

app.delete("/delete", (req, res) => {
	req.body._id = parseInt(req.body._id);

	const delete_data = { _id: req.body._id, 작성자 : req.user._id}
	db.collection("post").deleteOne(delete_data, (err, result) => {
		console.log("삭제완료");
		res.status(200).send({ message: "성공했습니다" });
	});
});

app.put("/edit", (req, res) => {
	db.collection("post").updateOne({ _id: parseInt(req.body.id) }, { $set: { 제목: req.body.title, 날짜: req.body.date } }, (err, result) => {
		res.redirect("/list");
	});
});

app.post("/login", passport.authenticate("local", {
	failureRedirect: "/fail"
}), (req, res) => {
	res.redirect("/");
});

app.post("/register", (req, res) => {
	db.collection("login").insertOne({ id: req.body.id, pw: req.body.pw }, (err, result) => {
		res.redirect("/");
	});
});
