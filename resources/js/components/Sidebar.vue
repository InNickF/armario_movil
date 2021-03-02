<template>
  <sidebar-menu :menu="menu" />
</template>

<script>
    export default {
        data() {
            return {
                baseUrl: process.env.MIX_APP_URL,
                menu: [
                    {
                        header: true,
                        title: 'Main Navigation',
                        hiddenOnCollapse: true
                    },
                    // Mi cuenta
                    {
                        href: process.env.MIX_APP_URL + '/account/profile',
                        title: 'Mi cuenta',
                        icon: 'fa fa-user'
                    },

                    // Armario de compras
                    {
                        href: '',
                        title: 'Armario de compras',
                        icon: 'fa fa-chart-area',
                        child: [
                        {
                            href: process.env.MIX_APP_URL + '/account/orders',
                            title: 'Mis compras',
                            icon: 'fa fa-user'
                        },
                        {
                            href: process.env.MIX_APP_URL + '/acccount/wishlist',
                            title: 'Mis favoritos',
                            icon: 'fa fa-chart-area',
                        },
                        {
                            href: process.env.MIX_APP_URL + '/acccount/questions',
                            title: 'Mis preguntas',
                            icon: 'fa fa-chart-area',
                        },
                                ]
                    },

                    // Armario de ventas
                    {
                        href: '',
                        title: 'Armario de ventas',
                        icon: 'fa fa-chart-area',
                        child: [
                        {
                            href: process.env.MIX_APP_URL + '/account/products',
                            title: 'Mis productos',
                            icon: 'fa fa-user'
                        },
                        {
                            href: process.env.MIX_APP_URL + '/acccount/outfits',
                            title: 'Mis outfits',
                            icon: 'fa fa-chart-area',
                        },
                        {
                            href: process.env.MIX_APP_URL + '/acccount/stories',
                            title: 'Mis historias',
                            icon: 'fa fa-chart-area',
                        },
                        {
                            href: process.env.MIX_APP_URL + '/account/orders',
                            title: 'Mis ventas',
                            icon: 'fa fa-user'
                        },
                        {
                            href: process.env.MIX_APP_URL + '/account/storeReviews',
                            title: 'Mis calificaciones',
                            icon: 'fa fa-chart-area',
                        },
                        {
                            href: process.env.MIX_APP_URL + '/acccount/plans',
                            title: 'Mi suscripción',
                            icon: 'fa fa-chart-area',
                        },
                         {
                            href: process.env.MIX_APP_URL + '/acccount/answers',
                            title: 'Preguntas recibidas',
                            icon: 'fa fa-chart-area',
                        },
                        {
                            href: process.env.MIX_APP_URL + '/acccount/gallery',
                            title: 'Galería de tienda',
                            icon: 'fa fa-chart-area',
                        },
                                ]
                    },

                    // Mis reportes
                     {
                        href: '',
                        title: 'Mis reportes',
                        icon: 'fa fa-chart-area',
                        child: [
                        {
                            href: process.env.MIX_APP_URL + '/account/dashboards/sell_records',
                            title: 'Historial de ventas',
                            icon: 'fa fa-user'
                        },
                        {
                            href: process.env.MIX_APP_URL + '/acccount/dashboards/business_profile',
                            title: 'Perfil comercial',
                            icon: 'fa fa-chart-area',
                        },
                        {
                            href: process.env.MIX_APP_URL + '/acccount/dashboards/interactions',
                            title: 'Interacciones',
                            icon: 'fa fa-chart-area',
                        },
                        {
                            href: process.env.MIX_APP_URL + '/account/dashboards/products',
                            title: 'Categorías de productos',
                            icon: 'fa fa-user'
                        },
                        {
                            href: process.env.MIX_APP_URL + '/acccount/dashboards/cities',
                            title: 'Ciudades',
                            icon: 'fa fa-chart-area',
                        },
                        {
                            href: process.env.MIX_APP_URL + '/acccount/dashboards/funnel',
                            title: 'Embudo',
                            icon: 'fa fa-chart-area',
                        },
                                ]
                    },

                    // Asesorías
                       {
                        href: '',
                        title: 'Asesorías',
                        icon: 'fa fa-chart-area',
                        child: [
                        {
                            href: process.env.MIX_APP_URL + '/account/articles/categorty/1',
                            title: 'Moda',
                            icon: 'fa fa-user'
                        },
                        {
                            href: process.env.MIX_APP_URL + '/account/articles/categorty/2',
                            title: 'Fotografía',
                            icon: 'fa fa-chart-area',
                        },
                        {
                            href: process.env.MIX_APP_URL + '/account/articles/categorty/3',
                            title: 'Marketing digital',
                            icon: 'fa fa-chart-area',
                        },
                        {
                            href: process.env.MIX_APP_URL + '/account/articles/categorty/4',
                            title: 'Negocios digitales',
                            icon: 'fa fa-user'
                        },
                                ]
                    },

                    // Ajustes
                     {
                        href: '',
                        title: 'Ajustes',
                        icon: 'fa fa-chart-area',
                        child: [
                        {
                            href: process.env.MIX_APP_URL + '/account/password',
                            title: 'Seguridad',
                            icon: 'fa fa-user'
                        },
                        {
                            href: process.env.MIX_APP_URL + '/account/addresses',
                            title: 'Localidades',
                            icon: 'fa fa-chart-area',
                        },
                        {
                            href: process.env.MIX_APP_URL + '/account/billing',
                            title: 'Facturación',
                            icon: 'fa fa-chart-area',
                        },
                        {
                            href: process.env.MIX_APP_URL + '/account/payment',
                            title: 'Pagos y cobros',
                            icon: 'fa fa-user'
                        },
                          {
                            href: process.env.MIX_APP_URL + '/account/notifications',
                            title: 'Notificaciones',
                            icon: 'fa fa-user'
                        },
                                ]
                    },

                    // Mis transacciones
                     {
                        href: process.env.MIX_APP_URL + '/account/transactions',
                        title: 'Mis transacciones',
                        icon: 'fa fa-chart-area',
                     },

                     // Asistencia
                     {
                        href: process.env.MIX_APP_URL + '/account/preguntas-frecuentes',
                        title: 'Asistencia',
                        icon: 'fa fa-chart-area',
                     },

                     // Cerrar sesión
                     {
                        href: process.env.MIX_APP_URL + '/account/logout',
                        title: 'Cerrar sesión',
                        icon: 'fa fa-chart-area',
                     },

                ]
            }
        }
    }
</script>