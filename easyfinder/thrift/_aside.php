<div class="mb-2 block lg:hidden">
            <div data-orientation="vertical">
              <div
                data-state="closed"
                data-orientation="vertical"
                class="border-b"
              >
                <h3
                  data-orientation="vertical"
                  data-state="closed"
                  class="flex"
                >
                  <button
                    type="button"
                    aria-controls="radix-:Rlmmja:"
                    aria-expanded="false"
                    data-state="closed"
                    data-orientation="vertical"
                    id="radix-:R5mmja:"
                    class="flex-1 hover:underline [&amp;[data-state=open]&gt;svg]:rotate-180 inline-flex items-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2 justify-start"
                    data-radix-collection-item=""
                  >
                    Menu<svg
                      width="15"
                      height="15"
                      viewBox="0 0 15 15"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-4 w-4 shrink-0 text-muted-foreground transition-transform duration-200"
                    >
                      <path
                        d="M3.13523 6.15803C3.3241 5.95657 3.64052 5.94637 3.84197 6.13523L7.5 9.56464L11.158 6.13523C11.3595 5.94637 11.6759 5.95657 11.8648 6.15803C12.0536 6.35949 12.0434 6.67591 11.842 6.86477L7.84197 10.6148C7.64964 10.7951 7.35036 10.7951 7.15803 10.6148L3.15803 6.86477C2.95657 6.67591 2.94637 6.35949 3.13523 6.15803Z"
                        fill="currentColor"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                  </button>
                </h3>
                <div
                  data-state="closed"
                  id="radix-:Rlmmja:"
                  hidden=""
                  role="region"
                  aria-labelledby="radix-:R5mmja:"
                  data-orientation="vertical"
                  class="overflow-hidden text-sm data-[state=closed]:animate-accordion-up data-[state=open]:animate-accordion-down"
                  style="
                    --radix-accordion-content-height: var(
                      --radix-collapsible-content-height
                    );
                    --radix-accordion-content-width: var(
                      --radix-collapsible-content-width
                    );
                  "
                ></div>
              </div>
            </div>
          </div>

<aside
            class="hidden rounded-lg border bg-white p-2 shadow-sm md:p-4 lg:block lg:w-1/4"
          >
            <nav class="flex flex-col flex-nowrap lg:space-y-2">
              
              <?php if($page=='_admin_dashboard'){?>
                  <a
                  class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 h-9 px-4 py-2 bg-orange-500 text-white hover:bg-orange-400 hover:text-white justify-start text-[15px]"
                  href="_admin_dashboard.php"
                  >Dashboard</a
                >
              <?php }else{ ?>
                  <a
                  class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                  href="_admin_dashboard.php"
                  >Dashboard</a
                >
              <?php } ?>


              <?php if($page=='_admin_donors_top'){?>
                <a
                  class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 h-9 px-4 py-2 bg-orange-500 text-white hover:bg-orange-400 hover:text-white justify-start text-[15px]"
                  href="_admin_donors_top.php"
                  >Donors</a
                >
              <?php }else{ ?>
                <a
                  class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                  href="_admin_donors_top.php"
                  >Donors</a
                >
              <?php } ?>

              <div class="flex flex-col">
                <a
                  class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                  >Donations</a
                >
                
                <div class="flex flex-col pl-6">
                  
                  <?php if($page=='_admin_create_donation'){?>
                    <a
                        class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 h-9 px-4 py-2 bg-orange-500 text-white hover:bg-orange-400 hover:text-white justify-start text-[15px]" 
                        href="_admin_create_donation.php?id=-1&task=new&admin_campaigns_list_component_searchTerm=<?php echo $admin_campaigns_list_component_searchTerm;?>"
                        >Create Donation</a
                      >
                  <?php }else{ ?>
                      <a
                      class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                      href="_admin_create_donation.php?id=-1&task=new&admin_campaigns_list_component_searchTerm=<?php echo $admin_campaigns_list_component_searchTerm;?>"
                      >Create Donation</a
                    >
                  <?php } ?>
                </div>
              </div>
              <div class="flex flex-col">
                <a
                  class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                  href="admin_withdrawals_list_page.php"
                  >Withdrawals</a
                >
                <div class="flex flex-col pl-6">
                  <a
                    class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 rounded-l-none border-l border-gray-300 hover:bg-muted hover:underline justify-start text-[15px]" 
                    href="" 
                    onlick="alets();" 
                    >Withdrawals Configure</a
                  ><script type="text/javascript">function alets(event){event.preventDefault();alert('Work in Progress');}</script>
                </div>
              </div>
              
              <?php if($page=='_admin_campaigns' || $page=='_admin_campaign_view'){?>
                    <a
                    class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 h-9 px-4 py-2 bg-orange-500 text-white hover:bg-orange-400 hover:text-white justify-start text-[15px]"
                    href="_admin_campaigns.php"
                    >Campaigns</a
                  >
              <?php }else{ ?>
                    <a
                    class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                    href="_admin_campaigns.php"
                    >Campaigns</a
                  >
              <?php } ?>

              <?php if($page=='_admin_profile'){?>
                  <a
                    class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 h-9 px-4 py-2 bg-orange-500 text-white hover:bg-orange-400 hover:text-white justify-start text-[15px]"
                    href="profile.php"
                    >About Organization</a
                  >
              <?php }else{ ?>
                    <a
                    class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                    href="profile.php"
                    >About Organization</a
                  >
              <?php } ?>

              <?php if($page=='_admin_categories'){?>
                <a
                  class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 h-9 px-4 py-2 bg-orange-500 text-white hover:bg-orange-400 hover:text-white justify-start text-[15px]"
                  href="_admin_categories.php"
                  >Categories</a
                >
              <?php }else{ ?>
                  <a
                  class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                  href="_admin_categories.php"
                  >Categories</a
                >
              <?php } ?>

              <a
                class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                href="logout.php"
                >Logout</a
              >

              <!--a
                class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                href="/organization/status"
                >Status</a
              ><a
                class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                href="/docs"
                >Documentation</a
              ><a
                class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                href="/account"
                >Account</a
              ><a
                class="inline-flex items-center rounded-md font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 hover:text-accent-foreground h-9 px-4 py-2 hover:bg-muted hover:underline justify-start text-[15px]"
                href="/account/settings"
                >Settings</a
              -->
            </nav>
          </aside>

          <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
    var aside = document.querySelector("aside");
    var menuButton = document.getElementById("radix-:R5mmja:");

    menuButton.addEventListener("click", function() {
        if (window.getComputedStyle(aside).display === "none" || window.getComputedStyle(aside).display === "") {
            // If the aside is hidden, show it
            aside.style.display = "block";
        } else {
            // If the aside is visible, hide it
            aside.style.display = "none";
        }
    });
});

          </script>