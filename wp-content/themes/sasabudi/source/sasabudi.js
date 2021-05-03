import { AppModal } from './theme_js/base/app-modal'
import { AppSticky } from './theme_js/base/app-sticky'
import { AppObserver } from './theme_js/base/app-observer'
import { AppBanner } from './theme_js/base/app-banner'
import { AppFAQ } from './theme_js/base/app-faq'
import { AppSearch } from './theme_js/base/app-search'
import { AppSwipers } from './theme_js/base/app-swipers'
import { AppAccount } from './theme_js/pages/account/app-account'
import { AppSupport } from './theme_js/pages/support/app-support'
import { AppPolicy } from './theme_js/pages/policy/app-policy'
import { AppBlog } from './theme_js/pages/blog/app-blog'
import { AppCart } from './theme_js/pages/cart/app-cart'
import { AppSwatches } from './theme_js/pages/catalog/app-swatches'
import { 	AppWishlist } from './theme_js/components/wishlist/app-wishlist'
import { ShopNotice } from './theme_js/components/shop/shop-notice'
import { StoreSelection } from './theme_js/components/store/store-selection'
import { OffsetMenu } from './theme_js/components/offset/left/offset-menu'
import { ContactForm } from './theme_js/pages/support/contact-form'
import { ArchiveCollections } from './theme_js/pages/collections/archive-collections'
import { ArchiveInstagram } from './theme_js/pages/instagram/archive-instagram'
import { CatalogBestseller } from './theme_js/components/catalog/catalog-bestseller'
import { CatalogFeaturing } from './theme_js/components/catalog/catalog-featuring'
import { FooterMenu } from './theme_js/components/footer/footer-menu'
import { FooterScroll } from './theme_js/components/footer/footer-scroll'
import { FooterSignup } from './theme_js/components/footer/footer-signup'

document.addEventListener('DOMContentLoaded', () => {
	// Add 'no-touch' class to the DOM if it's not a device
	if (!('ontouchstart' in document.documentElement)) {
		document.documentElement.className += 'no-touch'
	}
	AppModal()
	AppSticky()
	AppObserver()
	AppSearch()
	AppBanner()
	AppFAQ()
	AppSwipers()
	AppAccount()
	AppSupport()
	AppPolicy()
	AppBlog()
	AppCart()
	AppSwatches()
	AppWishlist()
	ShopNotice()
	StoreSelection()
	OffsetMenu()
	ContactForm()
	ArchiveCollections()
	ArchiveInstagram()
	CatalogBestseller()
	CatalogFeaturing()
	FooterScroll()
	FooterMenu()
	FooterSignup()
})