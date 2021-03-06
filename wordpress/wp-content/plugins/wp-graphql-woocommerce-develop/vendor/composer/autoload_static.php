<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8ad1f343d0cd8163c5fbabd591f04ce0
{
    public static $files = array (
        '914b07b8cf678ed0b81bfdb5d23b4f2b' => __DIR__ . '/../..' . '/includes/connection/common-post-type-args.php',
        '45a15019e901000ab8608c03ebff44fb' => __DIR__ . '/../..' . '/includes/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'WPGraphQL\\WooCommerce\\' => 22,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'WPGraphQL\\WooCommerce\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Firebase\\JWT\\BeforeValidException' => __DIR__ . '/..' . '/firebase/php-jwt/src/BeforeValidException.php',
        'Firebase\\JWT\\ExpiredException' => __DIR__ . '/..' . '/firebase/php-jwt/src/ExpiredException.php',
        'Firebase\\JWT\\JWT' => __DIR__ . '/..' . '/firebase/php-jwt/src/JWT.php',
        'Firebase\\JWT\\SignatureInvalidException' => __DIR__ . '/..' . '/firebase/php-jwt/src/SignatureInvalidException.php',
        'WPGraphQL\\WooCommerce\\ACF_Schema_Filters' => __DIR__ . '/../..' . '/includes/class-acf-schema-filters.php',
        'WPGraphQL\\WooCommerce\\Connection\\Cart_Items' => __DIR__ . '/../..' . '/includes/connection/class-cart-items.php',
        'WPGraphQL\\WooCommerce\\Connection\\Coupons' => __DIR__ . '/../..' . '/includes/connection/class-coupons.php',
        'WPGraphQL\\WooCommerce\\Connection\\Customers' => __DIR__ . '/../..' . '/includes/connection/class-customers.php',
        'WPGraphQL\\WooCommerce\\Connection\\Order_Items' => __DIR__ . '/../..' . '/includes/connection/class-order-items.php',
        'WPGraphQL\\WooCommerce\\Connection\\Orders' => __DIR__ . '/../..' . '/includes/connection/class-orders.php',
        'WPGraphQL\\WooCommerce\\Connection\\Payment_Gateways' => __DIR__ . '/../..' . '/includes/connection/class-payment-gateways.php',
        'WPGraphQL\\WooCommerce\\Connection\\Posts' => __DIR__ . '/../..' . '/includes/connection/class-posts.php',
        'WPGraphQL\\WooCommerce\\Connection\\Product_Attributes' => __DIR__ . '/../..' . '/includes/connection/class-product-attributes.php',
        'WPGraphQL\\WooCommerce\\Connection\\Products' => __DIR__ . '/../..' . '/includes/connection/class-products.php',
        'WPGraphQL\\WooCommerce\\Connection\\Refunds' => __DIR__ . '/../..' . '/includes/connection/class-refunds.php',
        'WPGraphQL\\WooCommerce\\Connection\\Shipping_Methods' => __DIR__ . '/../..' . '/includes/connection/class-shipping-methods.php',
        'WPGraphQL\\WooCommerce\\Connection\\Tax_Rates' => __DIR__ . '/../..' . '/includes/connection/class-tax-rates.php',
        'WPGraphQL\\WooCommerce\\Connection\\Variation_Attributes' => __DIR__ . '/../..' . '/includes/connection/class-variation-attributes.php',
        'WPGraphQL\\WooCommerce\\Connection\\WC_Terms' => __DIR__ . '/../..' . '/includes/connection/class-wc-terms.php',
        'WPGraphQL\\WooCommerce\\Core_Schema_Filters' => __DIR__ . '/../..' . '/includes/class-core-schema-filters.php',
        'WPGraphQL\\WooCommerce\\Data\\Connection\\Cart_Item_Connection_Resolver' => __DIR__ . '/../..' . '/includes/data/connection/class-cart-item-connection-resolver.php',
        'WPGraphQL\\WooCommerce\\Data\\Connection\\Common_CPT_Input_Sanitize_Functions' => __DIR__ . '/../..' . '/includes/data/connection/trait-common-cpt-args-processing.php',
        'WPGraphQL\\WooCommerce\\Data\\Connection\\Coupon_Connection_Resolver' => __DIR__ . '/../..' . '/includes/data/connection/class-coupon-connection-resolver.php',
        'WPGraphQL\\WooCommerce\\Data\\Connection\\Customer_Connection_Resolver' => __DIR__ . '/../..' . '/includes/data/connection/class-customer-connection-resolver.php',
        'WPGraphQL\\WooCommerce\\Data\\Connection\\Order_Connection_Resolver' => __DIR__ . '/../..' . '/includes/data/connection/class-order-connection-resolver.php',
        'WPGraphQL\\WooCommerce\\Data\\Connection\\Order_Item_Connection_Resolver' => __DIR__ . '/../..' . '/includes/data/connection/class-order-item-connection-resolver.php',
        'WPGraphQL\\WooCommerce\\Data\\Connection\\Payment_Gateway_Connection_Resolver' => __DIR__ . '/../..' . '/includes/data/connection/class-payment-gateway-connection-resolver.php',
        'WPGraphQL\\WooCommerce\\Data\\Connection\\Post_Connection_Resolver' => __DIR__ . '/../..' . '/includes/data/connection/class-post-connection-resolver.php',
        'WPGraphQL\\WooCommerce\\Data\\Connection\\Product_Attribute_Connection_Resolver' => __DIR__ . '/../..' . '/includes/data/connection/class-product-attribute-connection-resolver.php',
        'WPGraphQL\\WooCommerce\\Data\\Connection\\Product_Connection_Resolver' => __DIR__ . '/../..' . '/includes/data/connection/class-product-connection-resolver.php',
        'WPGraphQL\\WooCommerce\\Data\\Connection\\Refund_Connection_Resolver' => __DIR__ . '/../..' . '/includes/data/connection/class-refund-connection-resolver.php',
        'WPGraphQL\\WooCommerce\\Data\\Connection\\Shipping_Method_Connection_Resolver' => __DIR__ . '/../..' . '/includes/data/connection/class-shipping-method-connection-resolver.php',
        'WPGraphQL\\WooCommerce\\Data\\Connection\\Tax_Rate_Connection_Resolver' => __DIR__ . '/../..' . '/includes/data/connection/class-tax-rate-connection-resolver.php',
        'WPGraphQL\\WooCommerce\\Data\\Connection\\Variation_Attribute_Connection_Resolver' => __DIR__ . '/../..' . '/includes/data/connection/class-variation-attribute-connection-resolver.php',
        'WPGraphQL\\WooCommerce\\Data\\Connection\\WC_Terms_Connection_Resolver' => __DIR__ . '/../..' . '/includes/data/connection/class-wc-terms-connection-resolver.php',
        'WPGraphQL\\WooCommerce\\Data\\Factory' => __DIR__ . '/../..' . '/includes/data/class-factory.php',
        'WPGraphQL\\WooCommerce\\Data\\Loader\\WC_Customer_Loader' => __DIR__ . '/../..' . '/includes/data/loader/class-wc-customer-loader.php',
        'WPGraphQL\\WooCommerce\\Data\\Loader\\WC_Post_Crud_Loader' => __DIR__ . '/../..' . '/includes/data/loader/class-wc-post-crud-loader.php',
        'WPGraphQL\\WooCommerce\\Data\\Mutation\\Cart_Mutation' => __DIR__ . '/../..' . '/includes/data/mutation/class-cart-mutation.php',
        'WPGraphQL\\WooCommerce\\Data\\Mutation\\Checkout_Mutation' => __DIR__ . '/../..' . '/includes/data/mutation/class-checkout-mutation.php',
        'WPGraphQL\\WooCommerce\\Data\\Mutation\\Customer_Mutation' => __DIR__ . '/../..' . '/includes/data/mutation/class-customer-mutation.php',
        'WPGraphQL\\WooCommerce\\Data\\Mutation\\Order_Mutation' => __DIR__ . '/../..' . '/includes/data/mutation/class-order-mutation.php',
        'WPGraphQL\\WooCommerce\\JWT_Auth_Schema_Filters' => __DIR__ . '/../..' . '/includes/class-jwt-auth-schema-filters.php',
        'WPGraphQL\\WooCommerce\\Model\\Coupon' => __DIR__ . '/../..' . '/includes/model/class-coupon.php',
        'WPGraphQL\\WooCommerce\\Model\\Crud_CPT' => __DIR__ . '/../..' . '/includes/model/class-crud-cpt.php',
        'WPGraphQL\\WooCommerce\\Model\\Customer' => __DIR__ . '/../..' . '/includes/model/class-customer.php',
        'WPGraphQL\\WooCommerce\\Model\\Order' => __DIR__ . '/../..' . '/includes/model/class-order.php',
        'WPGraphQL\\WooCommerce\\Model\\Order_Item' => __DIR__ . '/../..' . '/includes/model/class-order-item.php',
        'WPGraphQL\\WooCommerce\\Model\\Product' => __DIR__ . '/../..' . '/includes/model/class-product.php',
        'WPGraphQL\\WooCommerce\\Model\\Product_Variation' => __DIR__ . '/../..' . '/includes/model/class-product-variation.php',
        'WPGraphQL\\WooCommerce\\Model\\Refund' => __DIR__ . '/../..' . '/includes/model/class-refund.php',
        'WPGraphQL\\WooCommerce\\Model\\Shipping_Method' => __DIR__ . '/../..' . '/includes/model/class-shipping-method.php',
        'WPGraphQL\\WooCommerce\\Model\\Shop_Manager_Caps' => __DIR__ . '/../..' . '/includes/model/trait-shop-manager-caps.php',
        'WPGraphQL\\WooCommerce\\Model\\Tax_Rate' => __DIR__ . '/../..' . '/includes/model/class-tax-rate.php',
        'WPGraphQL\\WooCommerce\\Mutation\\Cart_Add_Fee' => __DIR__ . '/../..' . '/includes/mutation/class-cart-add-fee.php',
        'WPGraphQL\\WooCommerce\\Mutation\\Cart_Add_Item' => __DIR__ . '/../..' . '/includes/mutation/class-cart-add-item.php',
        'WPGraphQL\\WooCommerce\\Mutation\\Cart_Apply_Coupon' => __DIR__ . '/../..' . '/includes/mutation/class-cart-apply-coupon.php',
        'WPGraphQL\\WooCommerce\\Mutation\\Cart_Empty' => __DIR__ . '/../..' . '/includes/mutation/class-cart-empty.php',
        'WPGraphQL\\WooCommerce\\Mutation\\Cart_Remove_Coupons' => __DIR__ . '/../..' . '/includes/mutation/class-cart-remove-coupons.php',
        'WPGraphQL\\WooCommerce\\Mutation\\Cart_Remove_Items' => __DIR__ . '/../..' . '/includes/mutation/class-cart-remove-items.php',
        'WPGraphQL\\WooCommerce\\Mutation\\Cart_Restore_Items' => __DIR__ . '/../..' . '/includes/mutation/class-cart-restore-items.php',
        'WPGraphQL\\WooCommerce\\Mutation\\Cart_Update_Item_Quantities' => __DIR__ . '/../..' . '/includes/mutation/class-cart-update-item-quantities.php',
        'WPGraphQL\\WooCommerce\\Mutation\\Cart_Update_Shipping_Method' => __DIR__ . '/../..' . '/includes/mutation/class-cart-update-shipping-method.php',
        'WPGraphQL\\WooCommerce\\Mutation\\Checkout' => __DIR__ . '/../..' . '/includes/mutation/class-checkout.php',
        'WPGraphQL\\WooCommerce\\Mutation\\Customer_Register' => __DIR__ . '/../..' . '/includes/mutation/class-customer-register.php',
        'WPGraphQL\\WooCommerce\\Mutation\\Customer_Update' => __DIR__ . '/../..' . '/includes/mutation/class-customer-update.php',
        'WPGraphQL\\WooCommerce\\Mutation\\Order_Create' => __DIR__ . '/../..' . '/includes/mutation/class-order-create.php',
        'WPGraphQL\\WooCommerce\\Mutation\\Order_Delete' => __DIR__ . '/../..' . '/includes/mutation/class-order-delete.php',
        'WPGraphQL\\WooCommerce\\Mutation\\Order_Delete_Items' => __DIR__ . '/../..' . '/includes/mutation/class-order-delete-items.php',
        'WPGraphQL\\WooCommerce\\Mutation\\Order_Update' => __DIR__ . '/../..' . '/includes/mutation/class-order-update.php',
        'WPGraphQL\\WooCommerce\\Type\\WPEnum\\Backorders' => __DIR__ . '/../..' . '/includes/type/enum/class-backorders.php',
        'WPGraphQL\\WooCommerce\\Type\\WPEnum\\Catalog_Visibility' => __DIR__ . '/../..' . '/includes/type/enum/class-catalog-visibility.php',
        'WPGraphQL\\WooCommerce\\Type\\WPEnum\\Countries' => __DIR__ . '/../..' . '/includes/type/enum/class-countries.php',
        'WPGraphQL\\WooCommerce\\Type\\WPEnum\\Customer_Connection_Orderby_Enum' => __DIR__ . '/../..' . '/includes/type/enum/class-customer-connection-orderby-enum.php',
        'WPGraphQL\\WooCommerce\\Type\\WPEnum\\Discount_Type' => __DIR__ . '/../..' . '/includes/type/enum/class-discount-type.php',
        'WPGraphQL\\WooCommerce\\Type\\WPEnum\\Manage_Stock' => __DIR__ . '/../..' . '/includes/type/enum/class-manage-stock.php',
        'WPGraphQL\\WooCommerce\\Type\\WPEnum\\Order_Status' => __DIR__ . '/../..' . '/includes/type/enum/class-order-status.php',
        'WPGraphQL\\WooCommerce\\Type\\WPEnum\\Orders_Orderby_Enum' => __DIR__ . '/../..' . '/includes/type/enum/class-orders-orderby-enum.php',
        'WPGraphQL\\WooCommerce\\Type\\WPEnum\\Post_Type_Orderby_Enum' => __DIR__ . '/../..' . '/includes/type/enum/class-post-type-orderby-enum.php',
        'WPGraphQL\\WooCommerce\\Type\\WPEnum\\Pricing_Field_Format' => __DIR__ . '/../..' . '/includes/type/enum/class-pricing-field-format.php',
        'WPGraphQL\\WooCommerce\\Type\\WPEnum\\Product_Taxonomy' => __DIR__ . '/../..' . '/includes/type/enum/class-product-taxonomy.php',
        'WPGraphQL\\WooCommerce\\Type\\WPEnum\\Product_Types' => __DIR__ . '/../..' . '/includes/type/enum/class-product-types.php',
        'WPGraphQL\\WooCommerce\\Type\\WPEnum\\Products_Orderby_Enum' => __DIR__ . '/../..' . '/includes/type/enum/class-products-orderby-enum.php',
        'WPGraphQL\\WooCommerce\\Type\\WPEnum\\Stock_Status' => __DIR__ . '/../..' . '/includes/type/enum/class-stock-status.php',
        'WPGraphQL\\WooCommerce\\Type\\WPEnum\\Tax_Class' => __DIR__ . '/../..' . '/includes/type/enum/class-tax-class.php',
        'WPGraphQL\\WooCommerce\\Type\\WPEnum\\Tax_Rate_Connection_Orderby_Enum' => __DIR__ . '/../..' . '/includes/type/enum/class-tax-rate-connection-orderby-enum.php',
        'WPGraphQL\\WooCommerce\\Type\\WPEnum\\Tax_Status' => __DIR__ . '/../..' . '/includes/type/enum/class-tax-status.php',
        'WPGraphQL\\WooCommerce\\Type\\WPEnum\\Taxonomy_Operator' => __DIR__ . '/../..' . '/includes/type/enum/class-taxonomy-operator.php',
        'WPGraphQL\\WooCommerce\\Type\\WPInputObject\\Cart_Item_Quantity_Input' => __DIR__ . '/../..' . '/includes/type/input/class-cart-item-quantity-input.php',
        'WPGraphQL\\WooCommerce\\Type\\WPInputObject\\Create_Account_Input' => __DIR__ . '/../..' . '/includes/type/input/class-create-account-input.php',
        'WPGraphQL\\WooCommerce\\Type\\WPInputObject\\Customer_Address_Input' => __DIR__ . '/../..' . '/includes/type/input/class-customer-address-input.php',
        'WPGraphQL\\WooCommerce\\Type\\WPInputObject\\Fee_Line_Input' => __DIR__ . '/../..' . '/includes/type/input/class-fee-line-input.php',
        'WPGraphQL\\WooCommerce\\Type\\WPInputObject\\Line_Item_Input' => __DIR__ . '/../..' . '/includes/type/input/class-line-item-input.php',
        'WPGraphQL\\WooCommerce\\Type\\WPInputObject\\Meta_Data_Input' => __DIR__ . '/../..' . '/includes/type/input/class-meta-data-input.php',
        'WPGraphQL\\WooCommerce\\Type\\WPInputObject\\Orderby_Inputs' => __DIR__ . '/../..' . '/includes/type/input/class-orderby-inputs.php',
        'WPGraphQL\\WooCommerce\\Type\\WPInputObject\\Product_Attribute_Input' => __DIR__ . '/../..' . '/includes/type/input/class-product-attribute-input.php',
        'WPGraphQL\\WooCommerce\\Type\\WPInputObject\\Product_Taxonomy_Filter_Input' => __DIR__ . '/../..' . '/includes/type/input/class-product-taxonomy-filter-input.php',
        'WPGraphQL\\WooCommerce\\Type\\WPInputObject\\Product_Taxonomy_Filter_Relation_Input' => __DIR__ . '/../..' . '/includes/type/input/class-product-taxonomy-filter-relation-input.php',
        'WPGraphQL\\WooCommerce\\Type\\WPInputObject\\Shipping_Line_Input' => __DIR__ . '/../..' . '/includes/type/input/class-shipping-line-input.php',
        'WPGraphQL\\WooCommerce\\Type\\WPInputObject\\Tax_Rate_Connection_Orderby_Input' => __DIR__ . '/../..' . '/includes/type/input/class-tax-rate-connection-orderby-input.php',
        'WPGraphQL\\WooCommerce\\Type\\WPInterface\\Product' => __DIR__ . '/../..' . '/includes/type/interface/class-product.php',
        'WPGraphQL\\WooCommerce\\Type\\WPObject\\Cart_Type' => __DIR__ . '/../..' . '/includes/type/object/class-cart-type.php',
        'WPGraphQL\\WooCommerce\\Type\\WPObject\\Coupon_Type' => __DIR__ . '/../..' . '/includes/type/object/class-coupon-type.php',
        'WPGraphQL\\WooCommerce\\Type\\WPObject\\Customer_Address_Type' => __DIR__ . '/../..' . '/includes/type/object/class-customer-address-type.php',
        'WPGraphQL\\WooCommerce\\Type\\WPObject\\Customer_Type' => __DIR__ . '/../..' . '/includes/type/object/class-customer-type.php',
        'WPGraphQL\\WooCommerce\\Type\\WPObject\\Meta_Data_Type' => __DIR__ . '/../..' . '/includes/type/object/class-meta-data-type.php',
        'WPGraphQL\\WooCommerce\\Type\\WPObject\\Order_Item_Type' => __DIR__ . '/../..' . '/includes/type/object/class-order-item-type.php',
        'WPGraphQL\\WooCommerce\\Type\\WPObject\\Order_Type' => __DIR__ . '/../..' . '/includes/type/object/class-order-type.php',
        'WPGraphQL\\WooCommerce\\Type\\WPObject\\Payment_Gateway_Type' => __DIR__ . '/../..' . '/includes/type/object/class-payment-gateway-type.php',
        'WPGraphQL\\WooCommerce\\Type\\WPObject\\Product_Attribute_Type' => __DIR__ . '/../..' . '/includes/type/object/class-product-attribute-type.php',
        'WPGraphQL\\WooCommerce\\Type\\WPObject\\Product_Category_Type' => __DIR__ . '/../..' . '/includes/type/object/class-product-category-type.php',
        'WPGraphQL\\WooCommerce\\Type\\WPObject\\Product_Download_Type' => __DIR__ . '/../..' . '/includes/type/object/class-product-download-type.php',
        'WPGraphQL\\WooCommerce\\Type\\WPObject\\Product_Types' => __DIR__ . '/../..' . '/includes/type/object/class-product-types.php',
        'WPGraphQL\\WooCommerce\\Type\\WPObject\\Product_Variation_Type' => __DIR__ . '/../..' . '/includes/type/object/class-product-variation-type.php',
        'WPGraphQL\\WooCommerce\\Type\\WPObject\\Refund_Type' => __DIR__ . '/../..' . '/includes/type/object/class-refund-type.php',
        'WPGraphQL\\WooCommerce\\Type\\WPObject\\Shipping_Method_Type' => __DIR__ . '/../..' . '/includes/type/object/class-shipping-method-type.php',
        'WPGraphQL\\WooCommerce\\Type\\WPObject\\Shipping_Package_Type' => __DIR__ . '/../..' . '/includes/type/object/class-shipping-package-type.php',
        'WPGraphQL\\WooCommerce\\Type\\WPObject\\Shipping_Rate_Type' => __DIR__ . '/../..' . '/includes/type/object/class-shipping-rate-type.php',
        'WPGraphQL\\WooCommerce\\Type\\WPObject\\Tax_Rate_Type' => __DIR__ . '/../..' . '/includes/type/object/class-tax-rate-type.php',
        'WPGraphQL\\WooCommerce\\Type\\WPObject\\Variation_Attribute_Type' => __DIR__ . '/../..' . '/includes/type/object/class-variation-attribute-type.php',
        'WPGraphQL\\WooCommerce\\Type_Registry' => __DIR__ . '/../..' . '/includes/class-type-registry.php',
        'WPGraphQL\\WooCommerce\\Utils\\QL_Session_Handler' => __DIR__ . '/../..' . '/includes/utils/class-ql-session-handler.php',
        'WPGraphQL\\WooCommerce\\WooCommerce_Filters' => __DIR__ . '/../..' . '/includes/class-woocommerce-filters.php',
        'WP_GraphQL_WooCommerce' => __DIR__ . '/../..' . '/includes/class-wp-graphql-woocommerce.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8ad1f343d0cd8163c5fbabd591f04ce0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8ad1f343d0cd8163c5fbabd591f04ce0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8ad1f343d0cd8163c5fbabd591f04ce0::$classMap;

        }, null, ClassLoader::class);
    }
}
