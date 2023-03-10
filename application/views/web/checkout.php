
            <?php $this->load->view('web/layout/navbar'); ?>


            <!-- Header Area End Here -->
            <!-- Begin Li's Breadcrumb Area -->
            <div class="breadcrumb-area">
                <div class="container-fluid">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="<?php echo base_url('/'); ?>">Home</a></li>
                            <li class="active"><?php echo $titulo; ?></li>
                         </ul>
                    </div>
                </div>
            </div>
<!-- ate aquuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuui ok !-->
            <!--Shopping Cart Area Strat-->
            <div class="Shopping-cart-area pt-5 pb-60">
                <div class="container-fluid">
                    <div class="row">
                        
                    <?php if (isset($carrinho) && !empty($carrinho)): ?>

                <div class="col-12">
                <div id="mensagem"></div>
                <form action="#">
                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="li-product-thumbnail">Imagens</th>
                                    <th class="cart-product-name">Produtos</th>
                                    <th class="li-product-price">Preço unitário</th>
                                    <th class="li-product-quantity">Quantidade</th>
                                    <th class="li-product-subtotal">Total</th>
                                </tr>
                            </thead>

                            <?php foreach ($carrinho as $produto): ?>

                            <tbody>
                                <tr>
                                    <td class="li-product-thumbnail"><a href="<?php echo base_url('produto/' .$produto['produto_meta_link']); ?>"><img width="50" src="<?php echo base_url('uploads/produtos/small/' .$produto['produto_foto']); ?>" alt="<?php echo $produto['produto_nome'] ?>"></a></td>
                                    <td class="li-product-name"><a href="<?php echo base_url('produto/' .$produto['produto_meta_link']); ?>"><?php echo word_limiter ($produto['produto_nome'], 4); ?></a></td>
                                    <td class="li-product-price"><span class="amount">R$&nbsp;<?php echo number_format($produto['produto_valor'], 2); ?></span></td>
                                    <td class="quantity" style="width: 50px">
                                        <div class="">
                                            <input id="produto_<?php echo $produto ['produto_id']; ?>" name="produto_quantidade" class="mask-produto-qty text-center pr-10" value="<?php echo $produto['produto_quantidade']; ?>" type="text" readonly="">
                                        </div>
                                          
                                        </td>

                                    <td class="product-subtotal"><span class="amount">R$&nbsp; <?php echo number_format ($produto['subtotal'], 2); ?></span></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <ul>
                                    <li>Total produtos <span>R$&nbsp;<?php echo $this->carrinho_compras->get_total(); ?></span></li>
                                    <li>Total frete<span id="opcao_frete_escolhido">R$&nbsp;0.00</span></li>
                                    <li>Total pedido<span id="total_final_carrinho">R$&nbsp;<?php echo $this->carrinho_compras->get_total(); ?></span></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="container-fluid mt-10">
                    <?php $logged_in = $this->ion_auth->logged_in(); ?>

                    <?php if(!$logged_in): ?>

                        <div class="row">
                        <div class="col-12">
                        <div class="row">
                        <div class="col-md-4">
                        <?php if ($message = $this->session->flashdata('erro')): ?>
                        <div class="alert alert-danger alert-has-icon alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                </button>
                                <?php echo $message; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        </div>
                        </div>
                            <div class="coupon-accordion">
                                <!--Accordion Start-->
                                <h3>Já é cliente? <span id="showlogin">Clique aqui para entrar</span></h3>
                                <div id="checkout-login" class="coupon-content">
                                    <div class="coupon-info">
                                        <?php echo form_open('login/auth'); ?>
                                        <form action="#">
                                            <p class="form-row-first">
                                                <label>E-mail <span class="required">*</span></label>
                                                <input type="text" name="email" required="">
                                            </p>
                                            <p class="form-row-last">
                                                <label>Password  <span class="required">*</span></label>
                                                <input type="password" name="password" required="">
                                            </p>
                                            <input type="hidden" name="login" value="checkout">
                                            <p class="form-row">
                                                <input value="Entrar" type="submit">
                                                <label>
                                                    <input type="checkbox" name="remember">
                                                     Manter conectado
                                                </label>
                                            </p>
                                            <p class="lost-password"><a href="#">Ainda não tem uma conta?</a></p>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                                <!--Accordion End-->

                            </div>
                        </div>
                    </div>

                        <?php endif; ?>

                        <div class="row mt-20">
                        
                        <div class="container-fluid">

                        <?php 
                        $atributos = array('class' => 'do-payment');
                         ?>

                            <?php echo form_open('pagar', $atributos); ?>

                            <input type="text" name="hash_pagamento" value="">

                           <?php if(!$logged_in): ?>

                            <div class="col-lg-4 col-12 float-left">
                                <div class="checkbox-form">
                                    <h3>DADOS PESSOAIS</h3>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="checkout-form-list">
                                                <label>Nome <span class="required">*</span></label>
                                                <input name="cliente_nome" type="text" value="<?php set_value('cliente_nome'); ?>" required="">
                                                <div id="cliente_nome" class="text-danger"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                        <div class="checkout-form-list">
                                                <label>Sobrenome <span class="required">*</span></label>
                                                <input name="cliente_sobrenome" type="text" value="<?php set_value('cliente_sobrenome'); ?>" required="">
                                                <div id="cliente_sobrenome" class="text-danger"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>CPF <span class="required">*</span></label>
                                                <input name="cliente_cpf" type="text" class="cpf" value="<?php set_value('cliente_cpf'); ?>" required="">
                                                <div id="cliente_cpf" class="text-danger"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="checkout-form-list">
                                                <label>Data nascimento <span class="required">*</span></label>
                                                <input name="cliente_data_nascimento" type="date" value="<?php set_value('cliente_data_nascimento'); ?>" required="">
                                                <div id="cliente_data_nascimento" class="text-danger"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Celular <span class="required">*</span></label>
                                                <input name="cliente_telefone_movel" type="tel" class="sp_celphones" value="<?php set_value('cliente_telefone_movel'); ?>" required="">
                                                <div id="cliente_telefone_movel" class="text-danger"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="checkout-form-list">
                                                <label>E-mail <span class="required">*</span></label>
                                                <input name="cliente_email" type="email" value="<?php set_value('cliente_email'); ?>" required="">
                                                <div id="cliente_email" class="text-danger"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Senha <span class="required">*</span></label>
                                                <input name="cliente_senha" type="password" value="<?php set_value('cliente_senha'); ?>" required="">
                                                <div id="cliente_senha" class="text-danger"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="checkout-form-list">
                                                <label>Confirmação <span class="required">*</span></label>
                                                <input name="confirmacao" type="password" required="">
                                                <div id="confirmacao" class="text-danger"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php endif; ?>


                            <div class="<?php echo ($logged_in ? 'col-lg-6' : 'col-lg-4'); ?> col-12 float-left">
                                <div class="checkbox-form">
                                    <h3>CALCULAR FRETE</h3>
                                    <div class="row">
 
                                        <div class="col-md-8">
                                            <div class="checkout-form-list">
                                                <label>CEP <span class="required">*</span></label>
                                                <input id="cliente_cep" class="cep" name="cliente_cep" type="text" value="<?php set_value('cliente_cep'); ?>" required="">
                                                <div id="cliente_cep" class="text-danger"></div>
                                                <div id="erro_frete">
                                            </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="checkout-form-list">
                                                <div class="order-button-payment">
                                                    <button class="btn btn-info" id="btn-busca-cep" style="height: 40px; margin: 28px 0 0; font-size: 14px; border-radius:1px" type="button">Calcular frete</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="colm-md-12 mt-0">
                                        <div id="erro_frete">
                                            </div>
                                        </div>

                                        <div class="col-md-12 endereco d-none">
                                            <div id="retorno-frete">
                                            </div>

                                            <div id="opcao_frete_carrinho" class="text-danger mt-2"></div>
                                            
                                        </div>

                                        <?php if(!$logged_in): ?>
                                        
                                            <div class="col-md-12 endereco d-none mt-20">
                                        <div class="checkout-form-list">
                                                <label>Endereco <span class="required">*</span></label>
                                                <input name="cliente_endereco" type="text" value="<?php set_value('cliente_endereco'); ?>" required="">
                                                <div id="cliente_endereco" class="text-danger"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 endereco d-none">
                                            <div class="checkout-form-list">
                                                <label>Número</label>
                                                <input name="cliente_numero_endereco" type="text"  value="<?php set_value('cliente_numero_endereco'); ?>" required="">
                                                <div id="cliente_numero_endereco" class="text-danger"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 endereco d-none">
                                        <div class="checkout-form-list">
                                                <label>Bairro <span class="required">*</span></label>
                                                <input name="cliente_bairro" type="text" value="<?php set_value('cliente_bairro'); ?>" required="">
                                                <div id="cliente_bairro" class="text-danger"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 endereco d-none">
                                            <div class="checkout-form-list">
                                                <label>Cidade <span class="required">*</span></label>
                                                <input name="cliente_cidade" type="text" value="<?php set_value('cliente_cidade'); ?>" required="">
                                                <div id="cliente_cidade" class="text-danger"></div>
                                            </div>
                                        </div>


                                         <div class="col-md-12 endereco d-none">
                                            <div class="country-select clearfix">
                                                <label>Estado <span class="required">*</span></label>
                                                <select class="custom-select" name="cliente_estado">
                                                <option value="">Escolha...</option>
                                                <option value="AC">Acre</option>
                                                <option value="AL">Alagoas</option>
                                                <option value="AP">Amapá</option>
                                                <option value="AM">Amazonas</option>
                                                <option value="BA">Bahia</option>
                                                <option value="CE">Ceará</option>
                                                <option value="DF">Distrito Federal</option>
                                                <option value="ES">Espírito Santo</option>
                                                <option value="GO">Goiás</option>
                                                <option value="MA">Maranhão</option>
                                                <option value="MT">Mato Grosso</option>
                                                <option value="MS">Mato Grosso do Sul</option>
                                                <option value="MG">Minas Gerais</option>
                                                <option value="PA">Pará</option>
                                                <option value="PB">Paraíba</option>
                                                <option value="PR">Paraná</option>
                                                <option value="PE">Pernambuco</option>
                                                <option value="PI">Piauí</option>
                                                <option value="RJ">Rio de Janeiro</option>
                                                <option value="RN">Rio Grande do Norte</option>
                                                <option value="RS">Rio Grande do Sul</option>
                                                <option value="RO">Rondônia</option>
                                                <option value="RR">Roraima</option>
                                                <option value="SC">Santa Catarina</option>
                                                <option value="SP">São Paulo</option>
                                                <option value="SE">Sergipe</option>
                                                <option value="TO">Tocantins</option>
                                                </select>
                                                <div id="cliente_estado" class="text-danger"></div>
                                            </div>
                                        </div>
                                            
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>


                            <div class="<?php echo ($logged_in ? 'col-lg-6' : 'col-lg-4'); ?> col-12 float-left">
                                <div class="checkbox-form">
                                    <h3>DADOS DE PAGAMENTO</h3>
                                    <div class="row">
 
                                        
                                    <div class="col-md-12">
                                            <div class="country-select clearfix">
                                                <label>Estado <span class="required">*</span></label>
                                                <select class="nice-select wide forma_pagamento" name="forma_pagamento">
                                                <option value="1" data-display="Cartão de crédito">Cartão de crédito</option>
                                                <option value="2">Boleto bancário</option>
                                                <option value="3">Débito em conta</option> 
                                                </select>
                                                <div id="forma_pagamento" class="text-danger"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-8 cartao">
                                            <div class="checkout-form-list">
                                                <label>Nome do titular do cartão <span class="required">*</span></label>
                                                <input name="numero_nome_titular" type="text" placeholder="Nome impresso no cartão" value="<?php set_value('numero_nome_titular'); ?>" required="">
                                                <div id="numero_nome_titular" class="text-danger"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 cartao">
                                            <div class="checkout-form-list">
                                                <label>Número do cartão <span class="required">*</span></label>
                                                <input name="numero_cartao" type="text" class="card_number" placeholder="0000 0000 0000 0000" value="<?php set_value('numero_cartao'); ?>" required="">
                                                <div id="numero_cartao" class="text-danger"></div>
                                            </div>
                                        </div>


                                        <div class="col-md-6 cartao">
                                            <div class="checkout-form-list">
                                                <label>Validade do cartão <span class="required">*</span></label>
                                                <input name="validade_cartao" type="text" class="card_expire" placeholder="MM/AAA" value="<?php set_value('validade_cartao'); ?>" required="">
                                                <div id="validade_cartao" class="text-danger"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 cartao">
                                            <div class="checkout-form-list">
                                                <label>CCV<span class="required">*</span></label>
                                                <input name="codigo_seguranca" type="text" class="card_ccv" placeholder="123" value="<?php set_value('codigo_seguranca'); ?>" required="">
                                                <div id="codigo_seguranca" class="text-danger"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 opcao-boleto d-none">

                                            <div class="checkout-form-list">
                                                
                                            <div class="alert alert-info" role="alert">
                                            <i class="fa fa-barcode fa-lg"></i>&nbsp;Você podera emitir o boleto ao final da compra!
                                            </div>

                                            <div class="order-button-payment">
                                            <input id="btn-pagar-boleto" value="Pagar com boleto" type="button" style="height: 40px; margin: 20px 0 0; font-size: 14px">
                                            </div>
                                            <div id="opcao_boleto" class="mt-2"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 opcao-debito-conta d-none">  
                                            <div class="checkout-form-list">
                                                <select class="nice-select wide" name="banco_escolhido">
                                                    <option value="">Escolha um banco..</option>
                                                    <option value="itau">Itau</option>
                                                    <option value="banrisul">Banrisul</option>
                                                    <option value="bradesco">Bradesco</option>
                                                    <!--<option value="bancodobrasil">Banco de Brasil</option> -->
                                                </select>
                                                <div id="opcao_banco"></div>
                                            </div>
                                            <div class="alert alert-info mt-50" role="alert">
                                            <i class="fa fa-university fa-lg"></i>&nbsp;Você podera acessar o ambiente seguro do seu banco ao final da compra!
                                            </div>

                                            <div class="order-button-payment">
                                            <input id="btn-debito-conta" value="Pagar com débito em conta" type="button" style="height: 40px; margin: 20px 0 0; font-size: 14px">
                                            </div>
                                            <div id="opcao_btn_debito_conta" class="mt-2"></div>
                                        </div>

                                        <div class="col-md-12 cartao">

                                        <div class="order-button-payment">
                                            <input id="btn-pagar-cartao" value="Pagar com cartão" type="button" style="height: 40px; margin: 28px 0 0; font-size: 14px">
                                        </div>

                                            <input id="token_pagamento" type="text" class="form-control" name="token_pagamento">
                                        
                                        <div id="opcao_pagar_cartao" class="mt-2">

                                        </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>


                        <?php echo form_close(); ?>
                    </div>
                </div>
                </div>

        <?php else: ?>

            <div class="col-12 pt-20">

            <h6 class="mb-30">Seu carrinho está vazio</h6>

                <div class="coupon-all">
                    <div class="coupon">
                    <a href="<?php echo base_url('/'); ?>" class="button"><input class="button" value="Continuar comprando" style="width: 240px"></a>
                </div>
            </div>
            
            <div class="container text-center">
                <img width="35%" src="<?php echo base_url('public/web/images/carrinho_vazio.svg'); ?>" alt="">
            </div>

        <?php endif; ?>

                    </div>
                </div>
            </div>
            <!--Shopping Cart Area End-->
            <!-- Begin Footer Area -->