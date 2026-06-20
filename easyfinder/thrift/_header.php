<header class="z-40 w-full border-b bg-white">
      <div
        class="mx-auto flex h-20 max-w-7xl items-center gap-6 px-6 md:h-24 lg:gap-12 lg:px-24"
      >
        <a href="index.php"
          ><h2
            class="scroll-m-20 pb-2 font-inter text-xl font-semibold md:text-2xl"
          >
            <?php echo APP_TITLE;?>
          </h2></a
        >
        <div class="hidden px-6 lg:block">
          <form method="get" action="_admin_campaigns.php">
          <input
            class="flex h-9 w-full rounded-md border border-input px-3 py-1 text-sm shadow-sm transition-colors file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:cursor-not-allowed disabled:opacity-50 max-w-[550px] bg-slate-50"
            placeholder="Search here..." 
            name="admin_campaigns_list_component_searchTerm" 
             aria-label="Type here"
                                value="<?php echo $searchTerm;?>"
          />

        </div>
        <button 
          type="submit"  
          class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-1 focus-visible:ring-ring disabled:pointer-events-none disabled:opacity-50 border border-input bg-background shadow-sm hover:bg-accent hover:text-accent-foreground h-9 w-9 ml-auto"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="lucide lucide-menu"
          >
            <line x1="4" x2="20" y1="12" y2="12"></line>
            <line x1="4" x2="20" y1="6" y2="6"></line>
            <line x1="4" x2="20" y1="18" y2="18"></line>
          </svg>
        </button>
      </form>
      </div>
    </header>
