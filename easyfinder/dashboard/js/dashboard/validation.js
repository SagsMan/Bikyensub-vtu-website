// window.addEventListener('DOMContentLoaded', () => {
//     document.getElementById('bvn-form').addEventListener('submit', async (e) => {
//         e.preventDefault();

//         const bvn = document.getElementById('bvn').value;
//         const resultDiv = document.getElementById('result');
//         const submitButton = document.querySelector('#bvn-form button');

//         const isValidBVN = (bvn) => /^\d{11}$/.test(bvn.toString());

//         if (!isValidBVN(bvn)) {
//             resultDiv.textContent = 'Please enter a valid 11-digit BVN.';
//             return;
//         }

//         submitButton.disabled = true;

//         try {
//             const response = await fetch('validate_bvn.php', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                 },
//                 body: JSON.stringify({ bvn }),
//             });

//             const data = await response.json();
//             if (data.success) {
//                 resultDiv.innerHTML = `<div class="alert alert-success">BVN is valid! Name: ${data.name}, DOB: ${data.dob}</div>`;
//             } else {
//                 resultDiv.innerHTML = `<div class="alert alert-danger">Error: ${data.message}</div>`;
//             }
//         } catch (error) {
//             resultDiv.innerHTML = `<div class="alert alert-danger">An error occurred while validating the BVN.</div>`;
//         } finally {
//             submitButton.disabled = false; // Re-enable button
//         }
//     });
// });

window.addEventListener("DOMContentLoaded", () => {
  document.getElementById("bvn-form")?.addEventListener("submit", async (e) => {
    e.preventDefault();

    const bvn = document.getElementById("bvn").value;
    const resultDiv = document.getElementById("result");
    const submitButton = document.querySelector("#bvn-form button");
    const spinner = document.getElementById("spinner");

    const isValidBVN = (bvn) => /^\d{11}$/.test(bvn.toString());

    if (!isValidBVN(bvn)) {
      toastr.error("Please enter a valid 11-digit BVN.", "Validation Error", {
        positionClass: "toast-top-right",
        timeOut: 5000,
        closeButton: true,
        progressBar: true,
      });
      return;
    }

    // Show spinner and disable button
    submitButton.disabled = true;
    spinner.classList.remove("d-none");

    try {
      const response = await fetch("../inc/index", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ action: "validate_bvn", bvn }),
      });

      const data = await response.json();

      if (data.success) {
        // toastr.success(`BVN is valid! Name: ${data.name}, DOB: ${data.dob}`, 'Validation Successful', {
        toastr.success(`${data.message}`, "Validation Successful", {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        });
        $("#BVNModal").modal("hide");

        printBVNSlip(data.data);
        // reload page
        // location.reload();
      } else {
        toastr.error(`Error: ${data.message}`, "Validation Failed", {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        });
      }
    } catch (error) {
      toastr.error(
        `An error occurred while validating the BVN: ${error}`,
        "Error",
        {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        }
      );
    } finally {
      // Hide spinner and enable button
      spinner.classList.add("d-none");
      submitButton.disabled = false;
    }
  });

  // Advanced BVN Slip
  document.getElementById("abvn-form")?.addEventListener("submit", async (e) => {
    e.preventDefault();

    const bvn = document.getElementById("advance_bvn").value;
    const resultDiv = document.getElementById("result");
    const submitButton = document.querySelector("#abvn-form button");
    const spinner = document.getElementById("spinner");

    const isValidBVN = (bvn) => /^\d{11}$/.test(bvn.toString());

    if (!isValidBVN(bvn)) {
      toastr.error("Please enter a valid 11-digit BVN.", "Validation Error", {
        positionClass: "toast-top-right",
        timeOut: 5000,
        closeButton: true,
        progressBar: true,
      });
      return;
    }

    // Show spinner and disable button
    submitButton.disabled = true;
    spinner.classList.remove("d-none");

    try {
      const response = await fetch("../inc/index", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ action: "advance_validate_bvn", bvn }),
      });

      const data = await response.json();

      if (data.success) {
        // toastr.success(`BVN is valid! Name: ${data.name}, DOB: ${data.dob}`, 'Validation Successful', {
        toastr.success(`${data.message}`, "Validation Successful", {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        });
        $("#ABVNModal").modal("hide");
        printBVNSlip(data.data);
        // reload page
        // location.reload();
      } else {
        toastr.error(`Error: ${data.message}`, "Validation Failed", {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        });
      }
    } catch (error) {
      toastr.error(
        `An error occurred while validating the BVN: ${error}`,
        "Error",
        {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        }
      );
    } finally {
      // Hide spinner and enable button
      spinner.classList.add("d-none");
      submitButton.disabled = false;
    }
  });

  /* NIN Verifications ********************************/
  // Improved NIN Slip
  // document.getElementById("nis-form")?.addEventListener("submit", async (e) => {
  //   e.preventDefault();

  //   const nin = document.getElementById("nin").value;
  //   const vnin = document.getElementById("vnin").value;
  //   const submitButton = document.querySelector("#nis-form button");
  //   const spinner = document.getElementById("spinner");

  //   const isValidNIN = (nin) => /^\d{11}$/.test(nin);
  //   const isValidVNIN = (vnin) => /^\d{11}$/.test(vnin);

  //   if (!isValidNIN(nin)) {
  //     toastr.error("Please enter a valid 11-digit NIN.", "Validation Error", {
  //       positionClass: "toast-top-right",
  //       timeOut: 5000,
  //       closeButton: true,
  //       progressBar: true,
  //     });
  //     return;
  //   }

  //   // Show spinner and disable button
  //   submitButton.disabled = true;
  //   spinner.classList.remove("d-none");

  //   try {
  //     const response = await fetch("./inc/validate_nis.php", {
  //       method: "POST",
  //       headers: {
  //         "Content-Type": "application/json",
  //       },
  //       body: JSON.stringify({ bvn }),
  //     });

  //     const data = await response.json();

  //     console.log(data);

  //     // if (data.success) {
  //     //     toastr.success(`BVN is valid! Name: ${data.name}, DOB: ${data.dob}`, 'Validation Successful', {
  //     //         positionClass: "toast-top-right",
  //     //         timeOut: 5000,
  //     //         closeButton: true,
  //     //         progressBar: true,
  //     //     });
  //     // } else {
  //     //     toastr.error(`Error: ${data.message}`, 'Validation Failed', {
  //     //         positionClass: "toast-top-right",
  //     //         timeOut: 5000,
  //     //         closeButton: true,
  //     //         progressBar: true,
  //     //     });
  //     // }
  //   } catch (error) {
  //     toastr.error(
  //       `An error occurred while validating the BVN: ${error}`,
  //       "Error",
  //       {
  //         positionClass: "toast-top-right",
  //         timeOut: 5000,
  //         closeButton: true,
  //         progressBar: true,
  //       }
  //     );
  //   } finally {
  //     // Hide spinner and enable button
  //     spinner.classList.add("d-none");
  //     submitButton.disabled = false;
  //   }
  // });
  // NIN Validation
  document
    .getElementById("nin-validation-form")
    ?.addEventListener("submit", async function (e) {
      e.preventDefault();

      const nin = document.getElementById("nin").value;
      const email = document.getElementById("email").value;
      const whatsapp_no = document.getElementById("whatsapp_no").value;
      const submitButton = document.querySelector(
        "#nin-validation-form button"
      );
      const spinner = document.getElementById("spinner");

      const isValidNIN = (nin) => /^\d{11}$/.test(nin);

      // check if the input are empty
      if (nin === "" || email === "" || whatsapp_no === "") {
        toastr.error(
          "Please fill all the required fields.",
          "Validation Error",
          {
            positionClass: "toast-top-right",
            timeOut: 5000,
            closeButton: true,
            progressBar: true,
          }
        );
        return;
      }

      // check if the NIN is valid
      if (!isValidNIN(nin)) {
        toastr.error("Please enter a valid 11-digit NIN.", "Validation Error", {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        });
        return;
      }

      // Show spinner and disable button
      submitButton.disabled = true;
      spinner.classList.remove("d-none");

      try {
        const response = await fetch("../inc/index", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            action: "validate_nin",
            nin,
            email,
            whatsapp_no,
          }),
        });

        const data = await response.json();

        if (data.success) {
          toastr.success(`${data.message}`, "Validation Successful", {
            positionClass: "toast-top-right",
            timeOut: 5000,
            closeButton: true,
            progressBar: true,
          });
          $("#NVModal").modal("hide");
          this.reset();
        } else {
          toastr.error(`Error: ${data.message}`, "Validation Failed", {
            positionClass: "toast-top-right",
            timeOut: 5000,
            closeButton: true,
            progressBar: true,
          });
        }
      } catch (error) {
        toastr.error(
          `An error occurred while processing NIN validating: ${error}`,
          "Error",
          {
            positionClass: "toast-top-right",
            timeOut: 5000,
            closeButton: true,
            progressBar: true,
          }
        );
      } finally {
        // Hide spinner and enable button
        spinner.classList.add("d-none");
        submitButton.disabled = false;
      }
    });

  // NIN Personalization
  document
    .getElementById("nin-personalization-form")
    ?.addEventListener("submit", async function (e) {
      e.preventDefault();

      const tracking_id = document.getElementById("tracking_id").value;
      const email = document.getElementById("email").value;
      const whatsapp_no = document.getElementById("whatsapp_no").value;
      const submitButton = document.querySelector(
        "#nin-personalization-form button"
      );
      const spinner = document.getElementById("spinner");

      const isValidTrackingID = (tracking_id) => /^\d{15}$/.test(tracking_id.toString());

      // check if the input are empty
      if (tracking_id === "" || email === "" || whatsapp_no === "") {
        toastr.error(
          "Please fill all the required fields.",
          "Validation Error",
          {
            positionClass: "toast-top-right",
            timeOut: 5000,
            closeButton: true,
            progressBar: true,
          }
        );
        return;
      }

      // check if the NIN is valid
      if (!isValidTrackingID(tracking_id)) {
        toastr.error("Please enter a valid 15-digit Tracking ID.", "Validation Error", {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        });
        return;
      }

      // Show spinner and disable button
      submitButton.disabled = true;
      spinner.classList.remove("d-none");

      try {
        const response = await fetch("../inc/index", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            action: "nin_personalization",
            tracking_id,
            email,
            whatsapp_no,
          }),
        });

        const data = await response.json();

        if (data.success) {
          toastr.success(`${data.message}`, "Validation Successful", {
            positionClass: "toast-top-right",
            timeOut: 5000,
            closeButton: true,
            progressBar: true,
          });
          $("#NPModal").modal("hide");
          this.reset();
          location.reload();
        } else {
          toastr.error(`Error: ${data.message}`, "Validation Failed", {
            positionClass: "toast-top-right",
            timeOut: 5000,
            closeButton: true,
            progressBar: true,
          });
        }
      } catch (error) {
        toastr.error(
          `An error occurred while processing the personalization: ${error}`,
          "Error",
          {
            positionClass: "toast-top-right",
            timeOut: 5000,
            closeButton: true,
            progressBar: true,
          }
        );
      } finally {
        // Hide spinner and enable button
        spinner.classList.add("d-none");
        submitButton.disabled = false;
      }
    });

  // IPE Clearing
  document
    .getElementById("ipe-clearing-form")
    ?.addEventListener("submit", async function (e) {
      e.preventDefault();

      const tracking_id = document.getElementById("tracking_id").value;
      const email = document.getElementById("email").value;
      const whatsapp_no = document.getElementById("whatsapp_no").value;
      const submitButton = document.querySelector("#ipe-clearing-form button");
      const spinner = document.getElementById("spinner");

      // check if the input are empty
      if (tracking_id === "" || email === "" || whatsapp_no === "") {
        toastr.error(
          "Please fill all the required fields.",
          "Validation Error",
          {
            positionClass: "toast-top-right",
            timeOut: 5000,
            closeButton: true,
            progressBar: true,
          }
        );
        return;
      }

      // Show spinner and disable button
      submitButton.disabled = true;
      spinner.classList.remove("d-none");

      try {
        const response = await fetch("../inc/index", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            action: "ipe_clearing",
            tracking_id,
            email,
            whatsapp_no,
          }),
        });

        const data = await response.json();

        if (data.success) {
          toastr.success(`${data.message}`, "Validation Successful", {
            positionClass: "toast-top-right",
            timeOut: 5000,
            closeButton: true,
            progressBar: true,
          });
          $("#ICModal").modal("hide");
          this.reset();
        } else {
          toastr.error(`Error: ${data.message}`, "Validation Failed", {
            positionClass: "toast-top-right",
            timeOut: 5000,
            closeButton: true,
            progressBar: true,
          });
        }
      } catch (error) {
        toastr.error(
          `An error occurred while validating the BVN: ${error}`,
          "Error",
          {
            positionClass: "toast-top-right",
            timeOut: 5000,
            closeButton: true,
            progressBar: true,
          }
        );
      } finally {
        // Hide spinner and enable button
        spinner.classList.add("d-none");
        submitButton.disabled = false;
      }
    });

  // NIN Modification
  document
    .getElementById("nin-modification-form")
    ?.addEventListener("submit", async function (e) {
      e.preventDefault();

      const formData = new FormData(this);

      const submitButton = document.querySelector(
        "#nin-modification-form button"
      );
      const spinner = document.getElementById("spinner");

      // Show spinner and disable button
      submitButton.disabled = true;
      spinner.classList.remove("d-none");

      try {
        const response = await fetch("../inc/index", {
          method: "POST",
          body: formData,
        });

        const data = await response.json();

        if (data.success) {
          toastr.success(`${data.message}`, "Validation Successful", {
            positionClass: "toast-top-right",
            timeOut: 5000,
            closeButton: true,
            progressBar: true,
          });
          this.reset();
        } else {
          toastr.error(`Error: ${data.message}`, "Validation Failed", {
            positionClass: "toast-top-right",
            timeOut: 5000,
            closeButton: true,
            progressBar: true,
          });
        }
      } catch (error) {
        toastr.error(
          `An error occurred while submitting the modifications: ${error}`,
          "Error",
          {
            positionClass: "toast-top-right",
            timeOut: 5000,
            closeButton: true,
            progressBar: true,
          }
        );
      } finally {
        // Hide spinner and enable button
        spinner.classList.add("d-none");
        submitButton.disabled = false;
      }
    });

  // Basic NIN slip
  document.getElementById("bns-form")?.addEventListener("submit", async (e) => {
    e.preventDefault();

    const nin = document.getElementById("nin_basic").value;
    const type = "Basic NIN Slip";
    const resultDiv = document.getElementById("result");
    const submitButton = document.querySelector("#bns-form button");
    const spinner = document.getElementById("spinner");

    const isValidNIN = (nin) => /^\d{11}$/.test(nin);

    if (!isValidNIN(nin)) {
      toastr.error("Please enter a valid 11-digit NIN.", "Validation Error", {
        positionClass: "toast-top-right",
        timeOut: 5000,
        closeButton: true,
        progressBar: true,
      });
      return;
    }

    // Show spinner and disable button
    submitButton.disabled = true;
    spinner.classList.remove("d-none");

    try {
      const response = await fetch("../inc/index", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ action: "basic_nin_slip", nin, type }),
      });

      const data = await response.json();

      if (data.success) {
        toastr.success(`Success: ${data.message}`, "Validation Successful", {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        });
        $("#NINBasicModal").modal("hide");
        // reload page
        // location.reload();
        printNINSlip(data.data);
      } else {
        toastr.error(`Error: ${data.message}`, "Validation Failed", {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        });
      }
    } catch (error) {
      toastr.error(
        `An error occurred while searching for NIN: ${error}`,
        "Error",
        {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        }
      );
    } finally {
      // Hide spinner and enable button
      spinner.classList.add("d-none");
      submitButton.disabled = false;
    }
  });

  // Regular NIN slip
  document.getElementById("nrs-form")?.addEventListener("submit", async (e) => {
    e.preventDefault();

    const nin = document.getElementById("nin_regular").value;
    const type = "Regular NIN Slip";
    const resultDiv = document.getElementById("result");
    const submitButton = document.querySelector("#nrs-form button");
    const spinner = document.getElementById("spinner");

    const isValidNIN = (nin) => /^\d{11}$/.test(nin.toString());

    if (!isValidNIN(nin)) {
      toastr.error("Please enter a valid 11-digit NIN.", "Validation Error", {
        positionClass: "toast-top-right",
        timeOut: 5000,
        closeButton: true,
        progressBar: true,
      });
      return;
    }

    // Show spinner and disable button
    submitButton.disabled = true;
    spinner.classList.remove("d-none");

    try {
      const response = await fetch("../inc/index", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ action: "regular_nin_slip", nin, type }),
      });

      const data = await response.json();

      if (data.success) {
        toastr.success(`Success: ${data.message}`, "Validation Successful", {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        });
        $("#NRSModal").modal("hide");
        // reload page
        printRegularNINSlip(data.data);
        // location.reload();
      } else {
        toastr.error(`Error: ${data.message}`, "Validation Failed", {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        });
      }
    } catch (error) {
      toastr.error(
        `An error occurred while searching for NIN: ${error}`,
        "Error",
        {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        }
      );
    } finally {
      // Hide spinner and enable button
      spinner.classList.add("d-none");
      submitButton.disabled = false;
    }
  });

  // Improve NIN slip
  document.getElementById("nis-form")?.addEventListener("submit", async (e) => {
    e.preventDefault();

    const nin = document.getElementById("nin_improve").value;
    const type = "Improved NIN Slip";
    const resultDiv = document.getElementById("result");
    const submitButton = document.querySelector("#nis-form button");
    const spinner = document.getElementById("spinner");

    const isValidNIN = (nin) => /^\d{11}$/.test(nin.toString());

    if (!isValidNIN(nin)) {
      toastr.error("Please enter a valid 11-digit NIN.", "Validation Error", {
        positionClass: "toast-top-right",
        timeOut: 5000,
        closeButton: true,
        progressBar: true,
      });
      return;
    }

    // Show spinner and disable button
    submitButton.disabled = true;
    spinner.classList.remove("d-none");

    try {
      const response = await fetch("../inc/index", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ action: "improved_nin_slip", nin, type }),
      });

      const data = await response.json();

      if (data.success) {
        toastr.success(`Success: ${data.message}`, "Validation Successful", {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        });
        $("#NRSModal").modal("hide");
        printImprovedNINSlip(data.data);
        // reload page
        // location.reload();
      } else {
        toastr.error(`Error: ${data.message}`, "Validation Failed", {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        });
      }
    } catch (error) {
      toastr.error(
        `An error occurred while searching for NIN: ${error}`,
        "Error",
        {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        }
      );
    } finally {
      // Hide spinner and enable button
      spinner.classList.add("d-none");
      submitButton.disabled = false;
    }
  });
  // Virtual NIN slip
  document.getElementById("vns-form")?.addEventListener("submit", async (e) => {
    e.preventDefault();

    const nin = document.getElementById("vnin_1").value;
    const type = "Virtual NIN Slip";
    const resultDiv = document.getElementById("result");
    const submitButton = document.querySelector("#vns-form button");
    const spinner = document.getElementById("spinner");

    // Show spinner and disable button
    submitButton.disabled = true;
    spinner.classList.remove("d-none");

    try {
      const response = await fetch("../inc/index", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ action: "virtual_nin_slip", nin, type }),
      });

      const data = await response.json();

      if (data.success) {
        toastr.success(`Success: ${data.message}`, "Validation Successful", {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        });
        $("#NRSModal").modal("hide");
        printVirtualNINSlip(data.data);
        // reload page
        // location.reload();
      } else {
        toastr.error(`Error: ${data.message}`, "Validation Failed", {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        });
      }
    } catch (error) {
      toastr.error(
        `An error occurred while searching for NIN: ${error}`,
        "Error",
        {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        }
      );
    } finally {
      // Hide spinner and enable button
      spinner.classList.add("d-none");
      submitButton.disabled = false;
    }
  });
  // Premium NIN slip
  document.getElementById("nps-form")?.addEventListener("submit", async (e) => {
    e.preventDefault();

    const nin = document.getElementById("nin").value;
    const type = "Premium NIN Slip";
    const resultDiv = document.getElementById("result");
    const submitButton = document.querySelector("#nps-form button");
    const spinner = document.querySelector("#nps-form #spinner");

    const isValidNIN = (nin) => /^\d{11}$/.test(nin.toString());

    if (!isValidNIN(nin)) {
      toastr.error("Please enter a valid 11-digit NIN.", "Validation Error", {
        positionClass: "toast-top-right",
        timeOut: 5000,
        closeButton: true,
        progressBar: true,
      });
      return;
    }

    // Show spinner and disable button
    submitButton.disabled = true;
    spinner.classList.remove("d-none");

    try {
      const response = await fetch("../inc/index", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ action: "premium_nin_slip", nin, type }),
      });

      const data = await response.json();

      if (data.success) {
        toastr.success(`Success: ${data.message}`, "Validation Successful", {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        });
        $("#NPSModal").modal("hide");
        printPremiumNINSlip(data.data);
      } else {
        toastr.error(`Error: ${data.message}`, "Validation Failed", {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        });
      }
    } catch (error) {
      toastr.error(
        `An error occurred while searching for NIN: ${error}`,
        "Error",
        {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        }
      );
    } finally {
      // Hide spinner and enable button
      spinner.classList.add("d-none");
      submitButton.disabled = false;
    }
  });

  // Phone Search Verification
  document.getElementById("ps-form")?.addEventListener("submit", async (e) => {
    e.preventDefault();

    const phone = document.getElementById("phone_num").value;
    const type = "Phone Search Slip";
    const resultDiv = document.getElementById("result");
    const submitButton = document.querySelector("#ps-form button");
    const spinner = document.querySelector("#ps-form #spinner");

    if (!phone) {
      toastr.error("Please enter a valid phone number.", "Validation Error", {
        positionClass: "toast-top-right",
        timeOut: 5000,
        closeButton: true,
        progressBar: true,
      });
      return;
    }

    // Show spinner and disable button
    submitButton.disabled = true;
    spinner.classList.remove("d-none");

    try {
      const response = await fetch("../inc/index", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ action: "phone_search_verification", phone, type }),
      });

      const data = await response.json();

      if (data.success) {
        toastr.success(`Success: ${data.message}`, "Validation Successful", {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        });
        $("#VNSModal").modal("hide");
        printPhoneSearchSlip(data.data);
      } else {
        toastr.error(`Error: ${data.message}`, "Validation Failed", {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        });
      }
    } catch (error) {
      toastr.error(
        `An error occurred while searching: ${error}`,
        "Error",
        {
          positionClass: "toast-top-right",
          timeOut: 5000,
          closeButton: true,
          progressBar: true,
        }
      );
    } finally {
      // Hide spinner and enable button
      spinner.classList.add("d-none");
      submitButton.disabled = false;
    }
  });

});

function convertImageToBase64(imgPath, callback) {
  const img = new Image();
  img.crossOrigin = 'Anonymous';  // Prevent CORS issues (ensure image allows cross-origin requests)
  img.src = imgPath;

  img.onload = function () {
      const canvas = document.createElement('canvas');
      canvas.width = img.width;
      canvas.height = img.height;

      const ctx = canvas.getContext('2d');
      ctx.drawImage(img, 0, 0);

      // Get Base64 string
      const dataURL = canvas.toDataURL('image/png');  // Convert to PNG (change to 'image/jpeg' for JPEG)
      callback(dataURL);
  };

  img.onerror = function () {
      console.error("Failed to load image: " + imgPath);
  };
}


function printBVNSlip(bvnDetail) {
  if (window.matchMedia("(max-width: 768px)").matches) {
    location.href = `./slip/bvn?id=${bvnDetail.id}`;
  } else {

    const printSection = document.getElementById("print-section");
    const ninLogo = '';

    const headerLogo = new Image();
    headerLogo.src = './images/verification/bvn-logo.jpeg';
    headerLogo.className = 'header-logo';

    headerLogo.onload =  function () {
      printSection.innerHTML = `
                <style>
          @media print {
              body {
                  margin: 0;
                  padding: 20px;
                  -webkit-print-color-adjust: exact;
                  print-color-adjust: exact;
              }
          }

          body {
              font-family: Arial, sans-serif;
              margin: 0;
              padding: 20px;
              background: #f5f5f5;
          }

          .container {
              width: 100%;
                min-width: 731px;
                max-width: 935px;
                margin: 30px 12px;
              background: white;
              box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
          }

          .header {
              display: flex;
              align-items: center;
              /* padding: 10px; */
              background: white;
              border: 1px solid #000;
              box-shadow: 0 0 2px rgb(0, 0, 0);
          }

          .header-logo {
              width: 150px;
              height: 40px;
          }

          .header-message {
              margin-left: 20px;
              font-size: 15px;
              text-align: center;
              width: 90%;
              font-weight: bold;
          }

          .date {
              text-align: right;
              padding: 15px 10px 2px 0;
              font-size: 14px;
          }

          .content {
              display: flex;
              gap: 20px;
          }

          .photo {
              width: 200px;
              height: 250px;
              background: #eee;
              border: 1px solid #ccc;
          }

          .info-table {
              flex: 1;
          }

          .info-table table {
              width: 100%;
              border-collapse: collapse;
          }

          .info-table th {
              padding: 5px;
              text-align: left;
              font-weight: normal;
              border: 1px solid #ccc;
              width: 32%;
              font-weight: bold;
          }

          .info-table td {
              padding: 5px;
              border: 1px solid #ccc;
          }

          .table-header {
              padding: 8px;
              border: 1px solid #ccc;
              color: #9e9e9e;
              font-weight: bold;
              text-align: center;
          }

          @media (max-width: 600px) {
              .content {
                  flex-direction: column;
              }

              .photo {
                  margin-inline: auto;
              }
          }
      </style>
        <div class="container">
          <div class="header">
              ${headerLogo.outerHTML}
              <div class="header-message">
                  The Bank Verification Number has successfully been verified.
              </div>
          </div>

          <div class="date">
              Date: ${new Date().toISOString()}
          </div>

          <div class="content">
              <img src="data:image/jpeg;base64,${bvnDetail.photo}" class="photo" />
              <div class="info-table">
                  <div class="table-header">Personal Information</div>
                  <table>
                      <tr>
                          <th>BVN</th>
                          <td>${bvnDetail.search_query}</td>
                      </tr>
                      ${
                          bvnDetail.type === "Advanced BVN Slip"
                              ? `<tr>
                                      <th>NIN</th>
                                      <td>${bvnDetail.nin}</td>
                                  </tr>`
                              : ""
                      }
                      <tr>
                          <th>First Name</th>
                          <td>${bvnDetail.first_name}</td>
                      </tr>
                      <tr>
                          <th>Last Name</th>
                          <td>${bvnDetail.last_name}</td>
                      </tr>
                      <tr>
                          <th>Middle Name</th>
                          <td>${bvnDetail.middle_name}</td>
                      </tr>
                      <tr>
                          <th>Phone</th>
                          <td>${bvnDetail.phone_number}</td>
                      </tr>
                      ${
                          bvnDetail.type === "Advanced BVN Slip"
                              ? `<tr>
                                      <th>Email</th>
                                      <td>${bvnDetail.owner_email}</td>
                                  </tr>`
                              : ""
                      }
                      <tr>
                          <th>Date of birth</th>
                          <td>${bvnDetail.date_of_birth}</td>
                      </tr>
                      <tr>
                          <th>Gender</th>
                          <td>${bvnDetail.gender}</td>
                      </tr>
                      ${
                          bvnDetail.type === "Advanced BVN Slip"
                              ? `
                                  <tr>
                                      <th>Enrollment Bank</th>
                                      <td>${bvnDetail.enrollment_bank}</td>
                                  </tr>
                                  <tr>
                                      <th>Enrollment Branch</th>
                                      <td>${bvnDetail.enrollment_branch}</td>
                                  </tr>
                                  <tr>
                                      <th>Registration Date</th>
                                      <td>${bvnDetail.registration_date}</td>
                                  </tr>
                                  <tr>
                                      <th>Address</th>
                                      <td>${bvnDetail.residential_address}</td>
                                  </tr>`
                              : ""
                      }
                  </table>
              </div>
          </div>
      </div>
            `;

      // Trigger print
      window.print();

      // Clear the print section to avoid confusion
      printSection.innerHTML = "";
    }
  }
}
function printNINSlip(ninDetail) {

  if (window.matchMedia("(max-width: 768px)").matches) {
    location.href = `./slip/basic_nin?id=${ninDetail.id}`;
  } else {

    const printSection = document.getElementById("print-section");
    const clone = printSection.cloneNode(true);
    const coatOfArms = new Image();
    coatOfArms.src = './images/verification/nigeria-govt-icon.jpg';
    coatOfArms.width = 100;

    coatOfArms.onload =  function () {
      clone.innerHTML = `
                <style>
            body {
                font-family: sans-serif;
                margin: 20px;
            }
            .nin-slip {
                border: 2px solid #000;
                padding: 2px;
                width: calc(100%, -13px);
                min-width: 731px;
                max-width: 935px;
                margin: 30px 12px;
                text-align: center;
            }
            .nin-slip .slip-header {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                justify-content: space-between;
            }
            .nin-slip .slip-header .header-text {
                flex: 0 0 82%;
                max-width: 82%;
            }
            .nin-slip .slip-header .header-text h1, 
            .nin-slip .slip-header .header-text h3,
            .nin-slip .slip-header .header-text p {
                color: #000;
            }
            .nin-slip .slip-header .header-text p {
                font-weight: 500;
            }
            .nin-slip .m-0 {
                margin: 0;
            }
            .nin-slip .p-0 {
                padding: 0;
            }
            .nin-slip .slip-header img {
                /* max-width: 100px; */
                margin-bottom: 10px;
                margin-right: auto;
            }
            .nin-slip .content {
                display: flex;
            }
            .nin-slip .content .details {
                flex: 0 0 75%;
                max-width: 75%;
                /* margin-left: auto; */
            }
            .nin-slip .content .image{
                /* flex: 0 0 32%; */
                max-width: 32%;
            }
            .nin-slip .content .image img{
                width: 100%;
            }
            .nin-slip h1 {
                font-size: 24px;
                /* margin-bottom: 10px; */
            }
            .nin-slip p {
                margin: 5px 0;
                font-size: 16px;
            }
            .nin-slip .info {
                text-align: left;
                margin-top: 20px;
            }
            .nin-slip .info p {
                margin: 5px 0;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                font-family: Arial, sans-serif;
                font-size: 16px;
                color: #575353;
            }

            table thead tr th {
                /* background-color: #f4f4f4; */
                text-align: center;
                padding: 10px;
                font-size: 18px;
                font-weight: bold;
                border: 1px solid #ddd;
            }

            table tbody tr td {
                border: 1px solid #ddd;
                padding: 10px;
            }

            /* table tbody tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            table tbody tr:hover {
                background-color: #f1f1f1;
            } */

            table tbody tr td:first-child {
                font-weight: bold;
                text-align: left;
            }

            table tbody tr td:last-child {
                text-align: center;
            }
        </style>
        <div class="nin-slip">
            <div class="slip-header">
                <div class="header-text">
                    <h1 class="m-0 p-0">National Identity Management System</h1>
                    <h3 class="m-0 p-0">federal Rebulic Of Nigeria</h3>
                    <p class="m-0 p-0">National Identification Number Slip (NINS)</p>
                </div>
                ${coatOfArms.outerHTML}
            </div>
            <div class="content">
                <div class="image">
                    <img src="data:image/jpeg;base64,${ninDetail.photo}" alt="NIN Photo">
                </div>
                <div class="details">
                    <table>
                        <thead>
                            <tr>
                                <th colspan="2">Personal Information</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>National Identification Number (NIN)</td>
                                <td>${ninDetail.nin}</td>
                            </tr>
                            <tr>
                                <td>First Name</td>
                                <td>${ninDetail.first_name}</td>
                            </tr>
                            <tr>
                                <td>Middle Name</td>
                                <td>${ninDetail.middle_name}</td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td>${ninDetail.last_name}</td>
                            </tr>
                            <tr>
                                <td>Phone Number</td>
                                <td>${ninDetail.phone_number}</td>
                            </tr>
                            <tr>
                                <td>Date of Birth</td>
                                <td>${ninDetail.date_of_birth}</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>${ninDetail.gender}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            `;

      // Append clone to body and print
      document.body.appendChild(clone);
      window.print();
    }
    window.onafterprint = () => {
        document.body.removeChild(clone);
    };
  }
}
function printRegularNINSlip(ninDetail) {
  if (window.matchMedia("(max-width: 768px)").matches) {
    location.href = `./slip/regular_nin?id=${ninDetail.id}`;
  } else {

    const printSection = document.getElementById("print-section");
    // const ninLogo = ``;

    let imagesLoaded = 0;  // Counter to track image load

    // Function to trigger print once both images are loaded
    function handlePrint() {
      imagesLoaded++;
      if (imagesLoaded === 2) {
        window.print();
        printSection.innerHTML = "";
      }
    }

    const coatOfArms = new Image();
    coatOfArms.src = './images/verification/nigeria-govt-icon.jpg';
    coatOfArms.className = "coat-of-arms";
    coatOfArms.onload = handlePrint;
    
    const nimcLogo = new Image();
    nimcLogo.src = './images/verification/nimc-icon.png';
    nimcLogo.className = "nimc-icon";
    nimcLogo.onload = handlePrint;

    // Wait for images to load
    // coatOfArms.onload = nimcLogo.onload = function () {
      printSection.innerHTML = `
            <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #fff;
                color: #000;
            }

            .nin-slip {
                /* width: 710px; */
                /* margin:  auto; */
                border: 3px solid #000;
                width: calc(100%, -23px);
                min-width: 900px;
                margin: 30px 10px;
            }

            .nin-slip .header {
                text-align: center;
                padding: 5px 0 5px;
                position: relative;
            }

            .nin-slip .header img {
                height: 50px;
                position: absolute;
                top: 5px;
            }
            .nin-slip .header .nimc-icon {
                right: 10px;
            }
            .nin-slip .header .coat-of-arms {
                left: 10px;
            }

            .nin-slip .header h1 {
                font-size: 20px;
                margin: 0;
            }

            .nin-slip .header p {
                margin: 2px 0;
                font-size: 16px;
            }

            .nin-slip .content table {
                width: 100%;
                border-collapse: collapse;
            }

            .nin-slip .content td, .content th {
                border: 1px solid #000;
                padding: 6px 8px;
                font-size: 14px;
                white-space: nowrap
            }

            .nin-slip .content th {
                background-color: #f9f9f9;
                text-align: left;
            }

            .nin-slip .address-wrapper {
                position: relative;
                display: flex;
                justify-content: space-between;
                /* align-items: flex-end; */
            }
            .nin-slip .address-block {
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                align-items: flex-start;
                /* height: 120px; */
                white-space: wrap;

            }

            .nin-slip .profile {
                height: 180px;
                align-self: flex-end;
            }

            .nin-slip .address-block div:nth-child(2) {
                position: absolute;
                bottom: 20px;
            }
            .nin-slip .address-block div:last-child {
                position: absolute;
                bottom: 0;
            }

            .nin-slip .note {
                margin: 5px;
                padding: 0 1px;
                line-height: 1.5em;
            }

            .nin-slip .note strong:nth-child(2) {
                font-style: italic;
            }

            .nin-slip .footer table {
                width: 100%;
                /* margin-top: 10px; */
                border: none;
                border-collapse: collapse;
            }

            .nin-slip .footer td {
                border: 1px solid #000;
                font-size: 12px;
                text-align: center;
                padding: 5px 10px;
            }

            .nin-slip .footer img {
                height: 20px;
                vertical-align: middle;
            }

        </style>
        <div class="nin-slip">
            <div class="header">
                ${coatOfArms.outerHTML}
                ${nimcLogo.outerHTML}
                <h1>National Identity Management System</h1>
                <p>Federal Republic of Nigeria</p>
                <p><strong>National Identification Number Slip (NINS)</strong></p>
            </div>

            <div class="content">
                <table>
                    <tr>
                        <td><strong>Tracking ID:</strong> ${ninDetail.tracking_id}</td>
                        <td><strong>Surname:</strong> ${ninDetail.last_name}</td>
                        <td rowspan="4">
                            <div class="address-wrapper">
                                <div>
                                  <strong>Address</strong>
                                  <div class="address-block">
                                      <div>${ninDetail.residence_adressline}</div>
                                      <div>${ninDetail.residence_lga}</div>
                                      <div>${ninDetail.residence_state}</div>
                                  </div>
                                </div>
                                <img src="data:image/jpeg;base64,${ninDetail.photo}" alt="Profile Photo" class="profile">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>NIN:</strong> ${ninDetail.nin}</td>
                        <td><strong>First Name:</strong> ${ninDetail.first_name}</td>
                    </tr>
                    <tr>
                        <td rowspan="2"></td>
                        <td><strong>Middle Name:</strong> ${ninDetail.middle_name}</td>
                    </tr>
                    <tr>
                        <td><strong>Gender:</strong> ${ninDetail.gender == 'Male' ? 'M': 'F'}</td>
                    </tr>
                </table>

                <p class="note"><strong>Note:</strong> The <strong>National Identification Number (NIN) is your identity</strong>. It is confidential and may only be released for legitimate transactions.</p>
                <p class="note">You will be notified when your National Identity Card is ready.</p>
            </div>

            <div class="footer">
                <table>
                    <tr>
                        <td><img src="./images/verification/helpdesk.png"> <br> <b>helpdesk@nimc.gov.ng</b></td>
                        <td><img src="./images/verification/internet-explorer-icon.png"> <br> <b>www.nimc.gov.ng</b></td>
                        <td><img src="./images/verification/call-48.png"> <br> <b>0700-CALL-NIMC</b> <br> <b>(0700-2255-646)</b></td>
                        <td><img src="./images/verification/postal-48.png"> <br>
                        <b>National Identification Management Commission</b><br>
                        11, Sokode Crescent, Zone 5 Wuse, Abuja</td>
                    </tr>
                </table>
            </div>
        </div>
            `;
          
      // window.setTimeout(() => {
      // Trigger print
      // window.print();

      // Clear the print section to avoid confusion
      // printSection.innerHTML = "";
      // }, 300);
    // }
  }
}

function printImprovedNINSlip(ninDetail) {
  if (window.matchMedia("(max-width: 768px)").matches) {
    location.href = `./slip/improved_nin?id=${ninDetail.id}`;
  } else {

    const printSection = document.getElementById("print-section");
    // const ninLogo = ``;

    let imagesLoaded = 0;  // Counter to track image load

    // Function to trigger print once both images are loaded
    function handlePrint() {
      imagesLoaded++;
      if (imagesLoaded === 2) {
        window.print();
        printSection.innerHTML = "";
      }
    }

    const coatOfArmsBG = new Image();
    coatOfArmsBG.src = './images/verification/nigeria-govt-icon.jpg';
    coatOfArmsBG.className = "coat-of-arms-watermark";
    coatOfArmsBG.onload = handlePrint;

    const coatOfArms = new Image();
    coatOfArms.src = './images/verification/nigeria-govt-icon.jpg';
    coatOfArms.onload = handlePrint;
    

    // Wait for images to load
    // coatOfArms.onload = nimcLogo.onload = function () {
      printSection.innerHTML = `
            <style>
          @media print {
              body {
                  margin: 0;
                  padding: 20px;
                  -webkit-print-color-adjust: exact;
                  print-color-adjust: exact;
              }
          }

          * {
              box-sizing: border-box;
          }

          body {
              font-family: 'Times New Roman', Times, serif;
              margin: 0;
              padding: 20px;
              background: #f5f5f5;
              display: flex;
              flex-direction: column;
              justify-content: center;
              align-items: center;
              gap: 12px;
              min-height: 100vh;
          }

          .nin-card {
              position: relative;
              display: grid;
              grid-template-rows: auto 1fr auto;
              max-width: 800px;
              width: 90%;
              margin-inline: auto;
              background: white;
              padding: 7px;
              box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
              border: 1px solid #ccc;
              margin: 30px auto 0;
          }

          .nin-back {
              font-family: Arial, Helvetica, sans-serif;
              max-width: 800px;
              width: 90%;
              margin-inline: auto;
              border: 2px solid #000;
              padding: 10px 15px;
              text-align: center;
              transform: rotate(180deg);
          }

          .nin-back .trust {
              font-family: "Charm", serif;
              font-weight: 400;
              font-style: normal;
          }

          .nin-back h1, .nin-back h2 {
              margin: 0;
          }

          .watermark-numbers {
              position: absolute;
              color: rgba(0, 0, 0, 0.1);
              font-size: 18px;
              white-space: nowrap;
              z-index: 100;
          }

          .watermark-left-1 {
              bottom: 100px;
              left: -10px;
              transform: rotate(-45deg);
          }

          .watermark-left-2 {
              bottom: 43px;
              left: 0;
              transform: rotate(-45deg);
          }

          .watermark-right {
              bottom: 60px;
              right: 10px;
              transform: rotate(45deg);
          }

          .coat-of-arms-watermark {
              position: absolute;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%);
              width: calc(100%, -30px);
              height: 100%;
              opacity: 0.08;
              /* background-image: url('../images/'); */
              background-size: contain;
              background-repeat: no-repeat;
              background-position: center;
              z-index: 0;
          }

          .coat-of-arms {
              text-align: center;
          }

          .coat-of-arms img {
              width: 100px;
          }

          .grid-container {
              display: grid;
              grid-template-columns: 1fr 2fr 1fr;
              gap: 20px;
              align-items: center;
              margin-top: -23px;
          }

          .photo-placeholder {
              width: 150px;
              height: 165px;
          }

          .details {
              display: flex;
              flex-direction: column;
          }

          .qr-code {
              width: 150px;
              height: 150px;
          }

          .nga-number {
              text-align: center;
              margin-top: 10px;
          }

          .nga-number span:first-child {
              font-size: 22px;
              font-weight: bold;
          }
          .nga-number span:last-child {
              display: inline-block;
              transform: scale(-1, -1);
          }

          .label {
              color: #666;
              font-size: 14px;
          }

          .value {
              font-size: 18px;
              margin-bottom: 15px;
          }

          .nin-number {
              text-align: center;
              font-size: 55px;
              font-weight: bold;
              letter-spacing: 3px;
          }

          .title {
              text-align: center;
              font-size: 16px;
              font-weight: bold;
          }

          .note {
              font-size: 9px;
              text-align: center;
              color: rgba(0, 0, 0, 0.5);
              font-style: italic;
          }

          .print-action {text-align: center;}

          .print-action button {
              padding: 14px;
              background-color: #10d596;
              color: #fff;
              font-size: 18px;
              border: none;
              border-radius: 4px;
              text-align: center;
              margin-inline: auto;
              cursor: pointer;
          }

          .print-action button:hover {
              background-color: #0fd17e;
          }

          /* Mobile Adjustments */
          @media (max-width: 600px) {
              .grid-container {
                  grid-template-columns: 1fr;
                  text-align: center;
                  margin-top: 0;
              }

              .photo-placeholder,
              .qr-code {
                  margin: 0 auto;
              }
          }

          @media print {
              .print-action {
                  display: none;
              }
          }
      </style>
        <div class="nin-card">
          ${coatOfArmsBG.outerHTML}
          <div class="watermark-numbers watermark-left-1">${ninDetail.nin}</div>
          <div class="watermark-numbers watermark-left-2">${ninDetail.nin}</div>
          <div class="watermark-numbers watermark-right">${ninDetail.nin}</div>
          <div class="coat-of-arms">
              ${coatOfArms.outerHTML}
          </div>

          <div class="grid-container">
              <img src="data:image/jpeg;base64,${ninDetail.photo}" class="photo-placeholder" alt="User Photo">
              <div class="details">
                  <div class="label">Surname/Nom</div>
                  <div class="value">${ninDetail.last_name}</div>

                  <div class="label">Given Names/Prénoms</div>
                  <div class="value">${ninDetail.first_name}, ${ninDetail.middle_name}</div>

                  <div class="label">Date of Birth</div>
                  <div class="value">${formatDate(ninDetail.date_of_birth)}</div>
              </div>

              <div style="margin-top: -30px">
                  <div class="nga-number"><span>NGA</span><br> <span>${ninDetail.nin}</span></div>
                  <img src="${ninDetail.qrcode}" class="qr-code" alt="QR Code">
              </div>
          </div>

          <div class="title">National Identification Number (NIN)</div>
          <div class="nin-number">${formatNIN(ninDetail.nin)}</div>

          <p class="note">
              Kindly ensure you scan the barcode to verify the credentials
          </p>
      </div>
      <div class="nin-back">
          <h1>DISCLAIMER</h1>
          <p class="trust">Trust, but verify</p>

          <p>Kindly ensure each time this ID is presented, that you verify the credentials 
              using a Government-APPROVED verification resource.</p>
          <p>The details on the front of this NIN Slip must EXACTLY match the verification result.</p>

          <h2>CAUTION!</h2>
          <p>If this NIN was not issued to the person on the front of this document, please DO NOt 
              attempt to scan, photocopy or replicate the personal data contained herein.</p>
          <p>You are only permitted to scan the barcode for the purpose of identity verification.</p>
          <p>The FEDERAL GOVERNMENT of NIGERIA assumes no responsibility if you accept variance in the 
              scan result or do not scan the 2D barcode overleaf
          </p>
      </div>
            `;
          
      // window.setTimeout(() => {
      // Trigger print
      // window.print();

      // Clear the print section to avoid confusion
      // printSection.innerHTML = "";
      // }, 300);
    // }
  }
}

function printVirtualNINSlip(ninDetail) {
  if (window.matchMedia("(max-width: 768px)").matches) {
    location.href = `./slip/vnin?id=${ninDetail.id}`;
  } else {

    const printSection = document.getElementById("print-section");
    // const ninLogo = ``;

    let imagesLoaded = 0;  // Counter to track image load

    // Function to trigger print once both images are loaded
    function handlePrint() {
      imagesLoaded++;
      if (imagesLoaded === 2) {
        window.print();
        printSection.innerHTML = "";
      }
    }

    const coatOfArmsBG = new Image();
    coatOfArmsBG.src = './images/verification/nigeria-govt-icon.jpg';
    coatOfArmsBG.className = "coat-of-arms-watermark";
    coatOfArmsBG.onload = handlePrint;

    const coatOfArms = new Image();
    coatOfArms.src = './images/verification/nigeria-govt-icon.jpg';
    coatOfArms.onload = handlePrint;
    

    // Wait for images to load
    // coatOfArms.onload = nimcLogo.onload = function () {
      printSection.innerHTML = `
          <style>
          body {
              font-family: Arial, sans-serif;
              margin: 0;
              padding: 0;
          }
          .container {
              width: 80%;
              min-width: 930px;
              margin: 20px auto;
              border: 1px solid #ddd;
              padding: 20px;
              box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
              position: relative;
              overflow: hidden;
          }
          .watermark-numbers {
              position: absolute;
              color: rgba(0, 0, 0, 0.1);
              font-size: 64px;
              white-space: nowrap;
              z-index: 100;
          }
          .watermark-1 {
              bottom: 100px;
              left: -160px;
              transform: rotate(-45deg);
          }

          .watermark-2 {
              bottom: 120px;
              left: 10%;
              transform: rotate(-45deg);
          }

          .watermark-3 {
              bottom: 60px;
              right: -70px;
              transform: rotate(-45deg);
          }
          .header {
              text-align: center;
          }
          .header img {
              width: 120px;
          }
          .title {
              font-size: 24px;
              margin: 10px 0;
          }
          .content {
              display: grid;
              grid-template-columns: 2fr 1fr;
              gap: 20px;
              align-items: center;
          }
          .content .first-part {
              display: flex;
              justify-content: flex-start;
          }
          .id-card {
              margin: 20px 0;
              border: 1px solid #ddd;
              padding: 10px;
              position: relative;
          }
          .coat-of-arms-watermark {
              position: absolute;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%);
              width: calc(100%, -30px);
              height: 100%;
              opacity: 0.08;
              /* background-image: url('../images/'); */
              background-size: contain;
              background-repeat: no-repeat;
              background-position: center;
              z-index: 0;
          }
          .id-card-header {
              text-align: center;
          }
          .id-card-header img {
              width: 90px;
          }
          .id-card-content {
              display: flex;
              justify-content: space-between;
              margin: 20px 0;
          }
          .photo-section img {
              width: 100%;
              min-width: 120px;
              height: 100%;
          }
          .id-card p {
              font-weight: bold;
              font-size: 12px;
              text-align: center;
              margin: 0;
          }
          .info-section {
              flex: 1;
              margin-left: 10px;
          }
          .info-section div {
              margin-bottom: 10px;
          }
          .info-section div strong {
              font-size: 0.8em;
              color: #aaa;
              white-space: nowrap;
          }
          .info-section-2 {
              margin: auto 4px;
          }
          .info-section-2 div {
              margin-bottom: 10px;
              white-space: nowrap;
          }
          .info-section-2 div span {
              font-size: 30px;
              font-weight: bolder;
              text-transform: uppercase;
          }
          .id-qrcode {
              text-align: right;
          }
          .id-qrcode b {
              margin-bottom: -15px;
              display: inline-block;
              width: 100%;
              text-align: center;
          }
          .id-qrcode img {
              width: 130px;
          }
          .table-section {
              margin-top: 5px;
          }
          table {
              width: 100%;
              border-collapse: collapse;
          }
          th, td {
              border: 1px solid #ddd;
              padding: 10px;
              text-align: left;
              white-space: nowrap;
          }
          th {
              background-color: #f4f4f4;
          }
          .qr-code {
              margin-top: 20px;
              text-align: right;
          }
          .qr-code img {
              width: 100%;
          }

          @media print {
              th {
                  -webkit-print-color-adjust: exact;
                  print-color-adjust: exact;
                  background-color: #f4f4f4 !important;
              }
          }
      </style>
        <div class="container">
          <div class="watermark-numbers watermark-1">${ninDetail.nin}</div>
          <div class="watermark-numbers watermark-2">${ninDetail.nin}</div>
          <div class="watermark-numbers watermark-3">${ninDetail.nin}</div>
          <div class="header">
              <img src="./images/verification/nimc-icon.png" alt="NIMC Logo">
              <h3 class="title">Verification-as-a-Service</h3>
          </div>

          <div class="content">
              <div class="first-part">
                  <div class="id-card">
                      ${coatOfArmsBG.outerHTML}
                      <div class="id-card-header">
                          ${coatOfArms.outerHTML}
                      </div>
                      <div class="id-card-content">
                          <div class="photo-section">
                              <img src="data:image/jpeg;base64,${ninDetail.photo}" alt="User Photo">
                          </div>
                          <div class="info-section">
                              <div><strong>Surname/Nom:</strong><br> ${ninDetail.last_name}</div>
                              <div><strong>Given Names/Prénoms:</strong><br> ${ninDetail.first_name}</div>
                              <div><strong>Date of Birth:</strong><br> ${formatDate(ninDetail.date_of_birth)}</div>
                          </div>
                          <div class="id-qrcode">
                              <b>NGA</b>
                              <img src="${ninDetail.qrcode}" />
                          </div>
                      </div>
                      <p>This document has been verified by NIMC</p>
      
                  </div>
                  <div class="info-section-2">
                      <div><strong>Surname/Nom:</strong><br> <span>${ninDetail.last_name}</span></div>
                      <div><strong>Given Names/Prénoms:</strong><br> <span>${ninDetail.first_name}</span></div>
                  </div>
              </div>
              <div class="qr-code">
                  <img src="${ninDetail.qrcode}" alt="QR Code">
              </div>
          </div>

          <div class="table-section">
              <table>
                  <tr>
                      <th>TimeStamp</th>
                      <th>Transaction ID</th>
                      <th>Verification Type</th>
                      <th>Verification Status</th>
                      <th>Verification Agent ID</th>
                  </tr>
                  <tr>
                      <td>${ninDetail.ts}</td>
                      <td>${ninDetail.txid}</td>
                      <td>TOKEN</td>
                      <td>OK</td>
                      <td>${ninDetail.agent_id}</td>
                  </tr>
              </table>
          </div>
      </div>
            `;
          
      // window.setTimeout(() => {
      // Trigger print
      // window.print();

      // Clear the print section to avoid confusion
      // printSection.innerHTML = "";
      // }, 300);
    // }
  }
}

function formatNIN(nin) {
  // Ensure the NIN is exactly 11 digits (in case of extra characters)
  const cleanNin = nin.replace(/\D/g, '');  // Remove non-digits
  if (cleanNin.length !== 11) return nin;   // Return as is if not 11 digits

  // Format to 4-3-4
  return `${cleanNin.slice(0, 4)} ${cleanNin.slice(4, 7)} ${cleanNin.slice(7)}`;
}

const formatDate = (dateString) => {
  const date = new Date(dateString);
  const day = date.getDate();
  const month = date.toLocaleString('en-US', { month: 'short' }).toUpperCase();
  const year = date.getFullYear();
  return `${day} ${month} ${year}`;
};


function printPremiumNINSlip(ninDetail) {
  if (window.matchMedia("(max-width: 768px)").matches) {
    location.href = `./slip/premium_nin?id=${ninDetail.id}`;
  } else {

    const printSection = document.getElementById("print-section");

    let imagesLoaded = 0;  // Counter to track image load

    // Function to trigger print once both images are loaded
    function handlePrint() {
      imagesLoaded++;
      if (imagesLoaded === 2) {
        window.print();
        printSection.innerHTML = "";
      }
    }

    const coatOfArms = new Image();
    coatOfArms.src = './images/verification/nigeria-govt-icon.jpg';
    coatOfArms.className = "coat-of-arms";
    coatOfArms.onload = handlePrint;
    
    const nimcLogo = new Image();
    nimcLogo.src = './images/verification/nimc-icon.png';
    nimcLogo.className = "nimc-icon";
    nimcLogo.onload = handlePrint;

      printSection.innerHTML = `
            <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #fff;
                color: #000;
            }

            .nin-slip {
                border: 3px solid #000;
                width: calc(100%, -23px);
                min-width: 900px;
                margin: 30px 10px;
            }

            .nin-slip .header {
                text-align: center;
                padding: 5px 0 5px;
                position: relative;
            }

            .nin-slip .header img {
                height: 50px;
                position: absolute;
                top: 5px;
            }
            .nin-slip .header .nimc-icon {
                right: 10px;
            }
            .nin-slip .header .coat-of-arms {
                left: 10px;
            }

            .nin-slip .header h1 {
                font-size: 20px;
                margin: 0;
            }

            .nin-slip .header p {
                margin: 2px 0;
                font-size: 16px;
            }

            .nin-slip .content table {
                width: 100%;
                border-collapse: collapse;
            }

            .nin-slip .content td, .content th {
                border: 1px solid #000;
                padding: 6px 8px;
                font-size: 14px;
                white-space: nowrap
            }

            .nin-slip .content th {
                background-color: #f9f9f9;
                text-align: left;
            }

            .nin-slip .address-wrapper {
                position: relative;
                display: flex;
                justify-content: space-between;
            }
            .nin-slip .address-block {
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                align-items: flex-start;
                white-space: wrap;

            }

            .nin-slip .profile {
                height: 180px;
                align-self: flex-end;
            }

            .nin-slip .address-block div:nth-child(2) {
                position: absolute;
                bottom: 20px;
            }
            .nin-slip .address-block div:last-child {
                position: absolute;
                bottom: 0;
            }

            .nin-slip .note {
                margin: 5px;
                padding: 0 1px;
                line-height: 1.5em;
            }

            .nin-slip .note strong:nth-child(2) {
                font-style: italic;
            }

            .nin-slip .footer table {
                width: 100%;
                border: none;
                border-collapse: collapse;
            }

            .nin-slip .footer td {
                border: 1px solid #000;
                font-size: 12px;
                text-align: center;
                padding: 5px 10px;
            }

            .nin-slip .footer img {
                height: 20px;
                vertical-align: middle;
            }

        </style>
        <div class="nin-slip">
            <div class="header">
                ${coatOfArms.outerHTML}
                ${nimcLogo.outerHTML}
                <h1>National Identity Management System</h1>
                <p>Federal Republic of Nigeria</p>
                <p><strong>National Identification Number Slip (NINS)</strong></p>
            </div>

            <div class="content">
                <table>
                    <tr>
                        <td><strong>Tracking ID:</strong> ${ninDetail.tracking_id || ''}</td>
                        <td><strong>Surname:</strong> ${ninDetail.last_name || ''}</td>
                        <td rowspan="4">
                            <div class="address-wrapper">
                                <div>
                                  <strong>Address</strong>
                                  <div class="address-block">
                                      <div>${ninDetail.residence_adressline || ''}</div>
                                      <div>${ninDetail.residence_lga || ''}</div>
                                      <div>${ninDetail.residence_state || ''}</div>
                                  </div>
                                </div>
                                <img src="data:image/jpeg;base64,${ninDetail.photo}" alt="Profile Photo" class="profile">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>NIN:</strong> ${ninDetail.nin || ''}</td>
                        <td><strong>First Name:</strong> ${ninDetail.first_name || ''}</td>
                    </tr>
                    <tr>
                        <td rowspan="2"></td>
                        <td><strong>Middle Name:</strong> ${ninDetail.middle_name || ''}</td>
                    </tr>
                    <tr>
                        <td><strong>Gender:</strong> ${ninDetail.gender == 'Male' ? 'M': 'F'}</td>
                    </tr>
                </table>

                <p class="note"><strong>Note:</strong> The <strong>National Identification Number (NIN) is your identity</strong>. It is confidential and may only be released for legitimate transactions.</p>
                <p class="note">You will be notified when your National Identity Card is ready.</p>
            </div>

            <div class="footer">
                <table>
                    <tr>
                        <td><img src="./images/verification/helpdesk.png"> <br> <b>helpdesk@nimc.gov.ng</b></td>
                        <td><img src="./images/verification/internet-explorer-icon.png"> <br> <b>www.nimc.gov.ng</b></td>
                        <td><img src="./images/verification/call-48.png"> <br> <b>0700-CALL-NIMC</b> <br> <b>(0700-2255-646)</b></td>
                        <td><img src="./images/verification/postal-48.png"> <br>
                        <b>National Identification Management Commission</b><br>
                        11, Sokode Crescent, Zone 5 Wuse, Abuja</td>
                    </tr>
                </table>
            </div>
        </div>
            `;
  }
}

function printPhoneSearchSlip(ninDetail) {
  if (window.matchMedia("(max-width: 768px)").matches) {
    location.href = `./slip/phone_search?id=${ninDetail.id}`;
  } else {

    const printSection = document.getElementById("print-section");

    let imagesLoaded = 0;  // Counter to track image load

    // Function to trigger print once both images are loaded
    function handlePrint() {
      imagesLoaded++;
      if (imagesLoaded === 2) {
        window.print();
        printSection.innerHTML = "";
      }
    }

    const coatOfArms = new Image();
    coatOfArms.src = './images/verification/nigeria-govt-icon.jpg';
    coatOfArms.className = "coat-of-arms";
    coatOfArms.onload = handlePrint;
    
    const nimcLogo = new Image();
    nimcLogo.src = './images/verification/nimc-icon.png';
    nimcLogo.className = "nimc-icon";
    nimcLogo.onload = handlePrint;

      printSection.innerHTML = `
            <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #fff;
                color: #000;
            }

            .nin-slip {
                border: 3px solid #000;
                width: calc(100%, -23px);
                min-width: 900px;
                margin: 30px 10px;
            }

            .nin-slip .header {
                text-align: center;
                padding: 5px 0 5px;
                position: relative;
            }

            .nin-slip .header img {
                height: 50px;
                position: absolute;
                top: 5px;
            }
            .nin-slip .header .nimc-icon {
                right: 10px;
            }
            .nin-slip .header .coat-of-arms {
                left: 10px;
            }

            .nin-slip .header h1 {
                font-size: 20px;
                margin: 0;
            }

            .nin-slip .header p {
                margin: 2px 0;
                font-size: 16px;
            }

            .nin-slip .content table {
                width: 100%;
                border-collapse: collapse;
            }

            .nin-slip .content td, .content th {
                border: 1px solid #000;
                padding: 6px 8px;
                font-size: 14px;
                white-space: nowrap
            }

            .nin-slip .content th {
                background-color: #f9f9f9;
                text-align: left;
            }

            .nin-slip .address-wrapper {
                position: relative;
                display: flex;
                justify-content: space-between;
            }
            .nin-slip .address-block {
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                align-items: flex-start;
                white-space: wrap;

            }

            .nin-slip .profile {
                height: 180px;
                align-self: flex-end;
            }

            .nin-slip .address-block div:nth-child(2) {
                position: absolute;
                bottom: 20px;
            }
            .nin-slip .address-block div:last-child {
                position: absolute;
                bottom: 0;
            }

            .nin-slip .note {
                margin: 5px;
                padding: 0 1px;
                line-height: 1.5em;
            }

            .nin-slip .note strong:nth-child(2) {
                font-style: italic;
            }

            .nin-slip .footer table {
                width: 100%;
                border: none;
                border-collapse: collapse;
            }

            .nin-slip .footer td {
                border: 1px solid #000;
                font-size: 12px;
                text-align: center;
                padding: 5px 10px;
            }

            .nin-slip .footer img {
                height: 20px;
                vertical-align: middle;
            }

        </style>
        <div class="nin-slip">
            <div class="header">
                ${coatOfArms.outerHTML}
                ${nimcLogo.outerHTML}
                <h1>National Identity Management System</h1>
                <p>Federal Republic of Nigeria</p>
                <p><strong>National Identification Number Slip (NINS)</strong></p>
            </div>

            <div class="content">
                <table>
                    <tr>
                        <td><strong>Tracking ID:</strong> ${ninDetail.tracking_id || ''}</td>
                        <td><strong>Surname:</strong> ${ninDetail.last_name || ''}</td>
                        <td rowspan="4">
                            <div class="address-wrapper">
                                <div>
                                  <strong>Address</strong>
                                  <div class="address-block">
                                      <div>${ninDetail.residence_adressline || ''}</div>
                                      <div>${ninDetail.residence_lga || ''}</div>
                                      <div>${ninDetail.residence_state || ''}</div>
                                  </div>
                                </div>
                                <img src="data:image/jpeg;base64,${ninDetail.photo}" alt="Profile Photo" class="profile">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>NIN:</strong> ${ninDetail.nin || ''}</td>
                        <td><strong>First Name:</strong> ${ninDetail.first_name || ''}</td>
                    </tr>
                    <tr>
                        <td rowspan="2"></td>
                        <td><strong>Middle Name:</strong> ${ninDetail.middle_name || ''}</td>
                    </tr>
                    <tr>
                        <td><strong>Gender:</strong> ${ninDetail.gender == 'Male' ? 'M': 'F'}</td>
                    </tr>
                </table>

                <p class="note"><strong>Note:</strong> The <strong>National Identification Number (NIN) is your identity</strong>. It is confidential and may only be released for legitimate transactions.</p>
                <p class="note">You will be notified when your National Identity Card is ready.</p>
            </div>

            <div class="footer">
                <table>
                    <tr>
                        <td><img src="./images/verification/helpdesk.png"> <br> <b>helpdesk@nimc.gov.ng</b></td>
                        <td><img src="./images/verification/internet-explorer-icon.png"> <br> <b>www.nimc.gov.ng</b></td>
                        <td><img src="./images/verification/call-48.png"> <br> <b>0700-CALL-NIMC</b> <br> <b>(0700-2255-646)</b></td>
                        <td><img src="./images/verification/postal-48.png"> <br>
                        <b>National Identification Management Commission</b><br>
                        11, Sokode Crescent, Zone 5 Wuse, Abuja</td>
                    </tr>
                </table>
            </div>
        </div>
            `;
  }
}
