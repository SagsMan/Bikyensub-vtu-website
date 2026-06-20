<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payboxed</title>
    <style>
      /* A simple css reset */
      body,
      table,
      thead,
      tbody,
      tr,
      td,
      img {
        padding: 0;
        margin: 0;
        border: none;
        border-spacing: 0px;
        border-collapse: collapse;
        vertical-align: top;
      }

      /* Add some padding for small screens */
      .wrapper {
        padding-left: 10px;
        padding-right: 10px;
      }

      h1,
      h2,
      h3,
      h4,
      h5,
      h6,
      p {
        margin: 0;
        padding: 0;
        padding-bottom: 20px;
        line-height: 1.6;
        font-family: "Helvetica", "Arial", sans-serif;
      }

      p,
      a,
      li {
        font-family: "Helvetica", "Arial", sans-serif;
      }

      td img {
        width: 100%;
        display: block;
      }

      @media only screen and (max-width: 620px) {
        .wrapper .section {
          width: 100%;
        }

        .wrapper .column {
          width: 100%;
          display: block;
        }
      }
    </style>
  </head>

  <body>
    <table width="100%">
      <p style="margin-top: 2%" align="center">
        <img
          src="https://payboxed.com.ng/dashboard/images/logo.png"
          style="text-align: center; width: 70px"
        />
      </p>

      <tbody>
        <tr>
          <td
            class="wrapper"
            width="600"
            align="center"
            style="margin-top: 10%"
          >
            <!-- Header image -->
            <table
              class="section header"
              cellpadding="0"
              cellspacing="0"
              width="600"
            >
              <tr style="border-top: thick solid #003366">
                <td class="column">
                  <table>
                    <tbody>
                      <tr>
                        <td align="left">
                          <img
                            src="https://payboxed.com.ng/dashboard/images/reset-password.jpg"
                            alt="picsum"
                            width="600"
                          />
                          <h2 style="text-align: center">
                            Reset Your Payboxed Inc Login Password.
                          </h2>
                          <p style="text-align: justify">
                            Dear {{ name }}, you are getting this message
                            because you request for reset login password.
                          </p>
                          <h3 style="text-align: justify; text-align: center">
                            Please click below link to reset your password :
                          </h3>
                          <p>
                            click
                            <a
                              href="https://payboxed.com.ng/dashboard/reset-password?email={{ email }}&token={{ token }}"
                            >
                              here
                            </a>
                            to reset password <br />
                            or copy this link to continue :
                          </p>
                          <p>
                            https://payboxed.com.ng/dashboard/reset-password?email={{email}}&token={{token}}
                          </p>

                          <h4 style="text-align: center">
                            Please
                            <a href="https://payboxed.com.ng/dashboard">
                              click here</a
                            >
                            to login
                          </h4>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </body>
</html>
