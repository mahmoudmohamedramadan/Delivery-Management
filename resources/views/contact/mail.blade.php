<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <style>
    body {
      background: #C5E1A5;
    }

    form {
      width: 60%;
      margin: 60px auto;
      background: #efefef;
      padding: 30px 90px 40px 90px;
      text-align: center;
      -webkit-box-shadow: 2px 2px 3px rgba(0, 0, 0, 0.1);
      box-shadow: 2px 2px 3px rgba(141, 139, 139, 0.1);
    }

    label {
      display: block;
      position: relative;
      margin: 40px 0px;
    }

    .label-txt {
      position: absolute;
      top: -1.6em;
      padding: 10px;
      font-family: sans-serif;
      font-size: .8em;
      letter-spacing: 1px;
      color: rgb(120, 120, 120);
      transition: ease .3s;
    }

    .input {
      width: 100%;
      padding: 10px;
      background: transparent;
      border: none;
      outline: none;
    }

    .line-box {
      position: relative;
      width: 100%;
      height: 2px;
      background: #BCBCBC;
    }

    .line {
      position: absolute;
      width: 0%;
      height: 2px;
      top: 0px;
      left: 50%;
      transform: translateX(-50%);
      background: #8BC34A;
      transition: ease .6s;
    }

    .button {
      display: inline-block;
      padding: 12px 24px;
      background: rgb(220, 220, 220);
      font-weight: bold;
      color: rgb(120, 120, 120);
      border: none;
      outline: none;
      border-radius: 3px;
      cursor: pointer;
      transition: ease .3s;
    }

  </style>
</head>
<body>
<form>
  <label>
    <span class="label-txt">{{ __('contact-us.labels.Name') }}</span>
    <input type="text" class="input" value="{{ $data['name'] }}"
           style="width: 400px" disabled>
    <div class="line-box">
      <div class="line"></div>
    </div>
  </label>
  <label>
    <span class="label-txt">{{ __('contact-us.labels.Email') }}</span>
    <input type="email" class="input" value="{{ $data['email'] }}"
           style="width: 400px" disabled>
    <div class="line-box">
      <div class="line"></div>
    </div>
  </label>
  <label>
      <span class="label-txt">{{ __('contact-us.labels.Message')
      }}</span>
    <textarea name="message" class="input"
              style="max-height: 150px;width: 400px;min-height: 100px"
              disabled>{{ $data['message']}}</textarea>
    <div class="line-box">
      <div class="line"></div>
    </div>
  </label>
</form>
</body>
</html>
